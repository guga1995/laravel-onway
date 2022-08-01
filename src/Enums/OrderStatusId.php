<?php

namespace Zorb\Onway\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

class OrderStatusId extends Enum implements LocalizedEnum
{
	const ToBeTaken = 1;
	const Taken = 18;
	const InTheWarehouse = 19;
	const ScoredForSubmission = 21;
	const Submitted = 22;
	const WaitingForVisa = 32;
	const DidNotSubmitted = 34;
	const Signed = 37;
	const CancellationOfPickup = 38;
	const CancellationOfAcceptance = 39;
	const IssuanceFromTheBranch = 40;
	const ReturnsToSender = 41;
	const SentToTheBranch = 42;
	const DidNotSubmittedFinished = 43;
	const ScoreAgain = 44;
	const ContractTaken = 45;
	const ReturnOfTheContract = 46;
	const CancellationOfOrder = 47;
	const Finished = 48;
	const ReceivedAtTheBranch = 49;
	const Exchange = 50;

	public static function getLocalizationKey(): string
    {
        return 'onway::statuses';
    }
}
