<?php

namespace Zorb\Onway\Transforms;

use Illuminate\Support\Carbon;

class UpdateOrderRequestTransform extends BaseTransform
{
	public function transform(): array
	{
		$order_info = $this->attributes['order_info'];

		return [
			"tracking_number" => $order_info["trackingnumber"],
			"from_name" => $order_info["from_name"],
			"from_company" => $order_info["from_company"],
			"from_address" => $order_info["from_address"],
			"from_phone" => $order_info["from_phone"],
			"from_city" => $order_info["from_city"],
			"to_name" => $order_info["to_name"],
			"to_company" => $order_info["to_company"],
			"to_address" => $order_info["to_address"],
			"to_phone" => $order_info["to_phone"],
			"to_city" => $order_info["to_city"],
			"from_date" => $order_info["from_date"],
			"to_date" => strtotime($order_info["to_date"]) ? Carbon::createFromFormat('d/m/Y', $order_info["to_date"])->toDateString() : null,
			"on_date" => strtotime($order_info["on_date"]) ? Carbon::parse($order_info["on_date"])->toDateString() : null,
			"off_date" => strtotime($order_info["off_date"]) ? Carbon::parse($order_info["of_date"])->toDateString() : null,
			"parcel" => (int)$order_info["parcel"],
			"weight" => (float)$order_info["weight"],
			"quantity" => (int)$order_info["quantity"],
			"order_detail" => $order_info["order_detail"],
			"order_number" => $order_info["order_number"],
			"order_price" => (float)$order_info["order_price"],
			"brittle" => (bool)$order_info["brittle"],
			"services" => [$order_info["services"]],
			"shipping_price" => (float)$order_info["shipping_price"],
			"additional_services_price" => (float)$order_info["additional_services_price"],
			"cash_amount" => (float)$order_info["cash_amount"],
			"payer_name" => $order_info["payer_name"],
			"pay" => (bool)$order_info["pay"],
			"status" => trans('onway::statuses.' . (int)$order_info["order_status_id"]),
			"order_status_id" => (int)$order_info["order_status_id"],
			"level" => $order_info["level"],
			"to_date_time" => $order_info["to_date_time"],
			"images" => $this->attributes["images"]
		];
	}
}
