<?php

use Zorb\Onway\Enums\OrderStatusId;

return [
    OrderStatusId::ToBeTaken => 'ასაღები',
    OrderStatusId::Taken => 'აღებული',
    OrderStatusId::InTheWarehouse => 'საწყობში',
    OrderStatusId::ScoredForSubmission => 'გატანილი ჩასაბარებლად',
    OrderStatusId::Submitted => 'ჩაბარებული',
    OrderStatusId::WaitingForVisa => 'ელოდება ვიზირებას',
    OrderStatusId::DidNotSubmitted => 'არ ჩაბარდა',
    OrderStatusId::Signed => 'გაფორმებული',
    OrderStatusId::CancellationOfPickup => 'აღების გაუქმება',
    OrderStatusId::CancellationOfAcceptance => 'მიღების გაუქმება',
    OrderStatusId::IssuanceFromTheBranch => 'ფილიალიდან გაცემა',
    OrderStatusId::ReturnsToSender => 'უბრუნდება გამგზავნს',
    OrderStatusId::SentToTheBranch => 'გაგზავნილი ფილიალში',
    OrderStatusId::DidNotSubmittedFinished => 'არ ჩაბარდა/დასრულებული',
    OrderStatusId::ScoreAgain => 'ხელმეორედ გატანა',
    OrderStatusId::ContractTaken => 'აღებული ხელშეკრულება',
    OrderStatusId::ReturnOfTheContract => 'ხელშეკრულების დაბრუნება',
    OrderStatusId::CancellationOfOrder => 'შეკვეთის გაუქმება',
    OrderStatusId::Finished => 'დასრულებული',
    OrderStatusId::ReceivedAtTheBranch => 'ფილიალში მიღება',
    OrderStatusId::Exchange => 'გაცვლა',
];
