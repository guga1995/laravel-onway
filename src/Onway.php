<?php

namespace Zorb\Onway;

use Zorb\Onway\Exceptions\OnwayProcessException;
use Zorb\Onway\Exceptions\OnwayRequestException;
use Illuminate\Support\Facades\Log;

class Onway
{
    //
    public function start(int $order_id, array $collection_location, array $delivery_location, float $weight, array $products = [], int $quantity = 1)
    {
        $result = $this->send('service/shipping/location', [
            'order_id' => $order_id,
            'CollectionLocation' => $collection_location,
            'DeliveryLocation' => $delivery_location,
            'Description' => implode(', ', $products),
            'DeliveryContactName' => '',
            'Quantity' => $quantity,
            'Weight' => $weight,
        ], true, true);

        if (isset($result->error)) {
            throw new OnwayRequestException($result->error);
        }

        return $result;
    }

    //
    public function confirm(int $order_id, string $declared_value = '')
    {
        $result = $this->send('service/shipping/confirm', [
            'DeclaredValue' => $declared_value,
            'order_id' => $order_id,
            'id' => config('onway.onway_id'),
        ]);

        if (isset($result->error)) {
            throw new OnwayRequestException($result->error);
        }

        return $result;
    }

    //
    public function status(int $order_id, int $tracking_number)
    {
        $result = $this->send('service/shipping/status', [
            'trackingNumber' => $tracking_number,
            'order_id' => $order_id,
            'id' => config('onway.onway_id'),
        ]);

        if (isset($result->error)) {
            throw new OnwayRequestException($result->error);
        }

        return $result;
    }

    //
    protected function send(string $run, array $data = [], bool $json = false, bool $set_headers = false)
    {
        $curl = curl_init();
        $api = config('onway.api_url');
        $params = $json ? json_encode($data) : http_build_query($data);

        if (config('onway.debug')) {
            Log::debug('Onway - data', [
                'data' => $params,
            ]);
        }

        $id = config('onway.onway_id');
        $headers = [
            "Authorization: {$id}",
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
