<?php

namespace Zorb\Onway\Transforms;

use Illuminate\Support\Carbon;

class OrderListTransform extends BaseTransform
{
	public function transform(): array
	{
		$data = array_map(function($item) {
            return [
                "tracking_number" => $item["tracking"],
                // "parent_tracking_number" => $item["parent_tracking_number"], //missing
                "from_name" => $item["from_name"],
                "from_company" => $item["from_company"],
                "from_address" => $item["from_address"],
                "from_phone" => $item["from_phone"],
                "from_city" => $item["from_city"],
                "to_name" => $item["to_name"],
                "to_company" => $item["to_company"],
                "to_address" => $item["to_address"],
                "to_phone" => $item["to_phone"],
                "to_city" => $item["to_city"],
                "from_date" => strtotime($item["from_date"]) ? Carbon::createFromFormat('d/m/Y', $item["from_date"])->toDateString() : null,
                "to_date" => strtotime($item["to_date"]) ? Carbon::createFromFormat('d/m/Y', $item["to_date"])->toDateString() : null,
                "on_date" => strtotime($item["on_date"]) ? Carbon::createFromFormat('d/m/Y', $item["on_date"])->toDateString() : null,
                // "off_date" => $item["off_date"], //missing
                "parcel" => (int)$item["parcel"],
                "weight" => (float)$item["weight"],
                "quantity" => (int)$item["quantity"],
                "order_detail" => $item["order_detail"],
                "order_number" => $item["order_number"],
                "order_price" => (float)$item["order_price"],
                "brittle" => (bool)$item["brittle"],
                "services" => [$item["services"]],
                // "shipping_price" => (float)$item["shipping_price"], //missing
                "additional_services_price" => (float)$item["additional_services_price"],
                "cash_amount" => (float)$item["cash_amount"],
                "payer_name" => $item["payer_name"],
                "pay" => (bool)$item["pay"],
                "status" => $item["status"],
                // "order_status_id" => (int)$item["order_status_id"], //missing // required
                // "level" => $item["level"], //missing
                // "to_date_time" => $item["to_date_time"], //missing // required
                // "images" => $item["images"] //missing
            ];
        }, $this->attributes['data']);

        return [
            'page' => $this->attributes["page"],
            'recordsTotal' => $this->attributes["recordsTotal"],
            'recordsFiltered' => $this->attributes["recordsFiltered"],
            'data' => $data,
        ];
	}
}
