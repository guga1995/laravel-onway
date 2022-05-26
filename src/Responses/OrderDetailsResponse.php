<?php

namespace Zorb\Onway\Responses;

use Zorb\Onway\Enums\OrderStatusId;

class OrderDetailsResponse extends BaseResponse
{
	protected function transform($attributes): array
	{
		$order_info = $attributes['order_info'];

		return [
			"order_info" => [
				"tracking_number" => $order_info["trackingnumber"],
				"parent_tracking_number" => $order_info["parent_trackingnumber"],
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
				"to_date" => $order_info["to_date"],
				"on_date" => $order_info["on_date"],
				"off_date" => $order_info["off_date"],
				"parcel" => (int)$order_info["parcel"],
				"weight" => (float)$order_info["weight"],
				"quantity" => (int)$order_info["quantity"],
				"order_detail" => $order_info["order_detail"],
				"order_number" => $order_info["order_number"],
				"order_price" => (float)$order_info["order_price"],
				"brittle" => (bool)$order_info["brittle"],
				"services" => $order_info["services"],
				"shipping_price" => (float)$order_info["shipping_price"],
				"additional_services_price" => (float)$order_info["additional_services_price"],
				"cash_amount" => (float)$order_info["cash_amount"],
				"payer_name" => $order_info["payer_name"],
				"pay" => (bool)$order_info["pay"],
				"status" => $order_info["status"],
				"order_status_id" => OrderStatusId::fromValue((int)$order_info["order_status_id"]),
				"level" => $order_info["level"],
				"to_date_time" => $order_info["to_date_time"],
			],
			"images" => $attributes["images"]
		];
	}
}
