<?php

namespace Zorb\Onway\Enums;

use BenSampo\Enum\Enum;

final class DeliveryStatus extends Enum
{
    const Submitted = 1;
    const InTransit = 2;
    const Completed = 3;
    const Canceled = 4;
    const CanceledBillable = 5;
}
