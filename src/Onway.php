<?php

namespace Zorb\Onway;

use Zorb\Onway\Contracts\Delivery as DeliveryContract;
use Zorb\Onway\Exceptions\OnwayProcessException;
use Zorb\Onway\Exceptions\OnwayRecordException;
use Zorb\Onway\Exceptions\OnwayRequestException;
use Illuminate\Support\Facades\Log;
use Zorb\Onway\Models\Delivery;

class Onway
{
    //
    protected $id;

    //
    protected $model;

    //
    public function __construct()
    {
        $this->id = config('onway.onway_id');

        if (!$this->model instanceof DeliveryContract) {
            $this->model = OnwayServiceProvider::getModelInstance();
        }
    }

    //
    public function start(array $collection_location, array $delivery_location, float $weight, array $products = [], int $quantity = 1)
    {
        $delivery = $this->model->create([
            'weight' => $weight,
            'quantity' => $quantity,
            'description' => implode(', ', $products),
            'delivery_location' => $delivery_location,
            'collection_location' => $collection_location,
        ]);

        $result = $this->send('service/shipping/location', [
            'order_id' => $delivery->id,
            'CollectionLocation' => $collection_location,
            'DeliveryLocation' => $delivery_location,
            'Description' => $delivery->description,
            'DeliveryContactName' => '',
            'Quantity' => $quantity,
            'Weight' => $weight,
        ], true, true);

        if (isset($result->error)) {
            throw new OnwayRequestException($result->error);
        }

        if (isset($result->order_id)) {
            $delivery->update(['order_id' => $result->order_id]);
        }

        return $result;
    }

    //
    public function confirm(int $order_id, string $declared_value = '')
    {
        if ($delivery = Delivery::where('order_id', $order_id)->first()) {
            $result = $this->send('service/shipping/confirm', [
                'DeclaredValue' => $declared_value,
                'order_id' => $delivery->id,
                'id' => $this->id,
            ]);

            if (isset($result->error)) {
                throw new OnwayRequestException($result->error);
            }

            if ($result->TrackingNumber) {
                $delivery->update(['tracking_number' => $result->TrackingNumber]);
            }

            return $result;
        }

        throw new OnwayRecordException("Delivery record not found for order_id of {$order_id}!");
    }

    //
    public function status(int $order_id)
    {
        if ($delivery = Delivery::where('order_id', $order_id)->first()) {
            $result = $this->send('service/shipping/status', [
                'trackingNumber' => $delivery->tracking_number,
                'order_id' => $delivery->id,
                'id' => $this->id,
            ]);

            if (isset($result->error)) {
                throw new OnwayRequestException($result->error);
            }

            if (isset($result->status_id)) {
                $delivery->update(['status' => $result->status_id]);
            }

            return $result;
        }

        throw new OnwayRecordException("Delivery record not found for order_id of {$order_id}!");
    }

    //
    protected function send(string $run, array $data = [], bool $json = false, bool $set_headers = false)
    {
        $curl = curl_init();
        $api = config('onway.api_url');
        $params = $json ? json_encode($data) : http_build_query($data);

        if (config('onway.debug')) {
            Log::debug('Onway -> data', [
                'data' => $params,
            ]);
        }

        $headers = [
            "Authorization: {$this->id}",
            'Content-Type: application/json'
        ];

        if (config('onway.debug')) {
            Log::debug('Onway - headers', $headers);
        }

        curl_setopt($curl, CURLOPT_URL, "{$api}?run={$run}");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        if ($set_headers) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        $info = curl_getinfo($curl);

        if (config('onway.debug')) {
            Log::debug($result);
            Log::debug($info);
        }

        if (curl_errno($curl)) {
            throw new OnwayProcessException(curl_error($curl));
        }

        if (!$result) {
            throw new OnwayProcessException('No result returned from curl request!');
        }

        curl_close($curl);

        return json_decode($result);
    }
}
