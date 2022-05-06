<?php

namespace Zorb\Onway\Enums;

use BenSampo\Enum\Enum;

class PaymentMethod extends Enum
{
	const Cash = 1;
	const CreditCard = 2;
	const Invoice = 3;
	const Terminal = 4;
}