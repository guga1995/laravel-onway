<?php

namespace Zorb\Onway\Transforms;

use Zorb\Onway\Enums\OrderStatusId;

class CreateOrderTransform extends BaseTransform
{
	public function transform(): array
	{
		$data = $this->attributes["data"];
		$order_info = $this->attributes["request_data"];

		return [
			"tracking_number" => $data["trackingnumber"],
			"from_name" => $order_info["from_name"],
			"from_company" => $order_info["from_company"],
			"from_address" => $order_info["from_address"],
			"from_phone" => $order_info["from_phone"],
			"from_city" => $order_info["from_city"],
			"to_name" => $order_info["to_name"],
			"to_address" => $order_info["to_address"],
			"to_phone" => $order_info["to_phone"],
			"to_city" => $order_info["to_city"],
			"parcel" => (int)$order_info["parcel"],
			"weight" => (float)$order_info["weight"],
			"quantity" => (int)$order_info["quantity"],
			"order_detail" => $order_info["order_detail"],
			"order_price" => (float)$order_info["order_price"],
			"services" => $order_info["services"],
			"order_status_id" =>  OrderStatusId::Status_39,
			"status" => trans('onway::statuses.' . OrderStatusId::Status_39),
		];
	}
}
