<?php

namespace Zorb\Onway\Enums;

use BenSampo\Enum\Enum;

class Payer extends Enum
{
	const Sender = 1;
	const Recipient = 2;
	const Customer = 3;
}