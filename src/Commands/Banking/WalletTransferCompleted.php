<?php

namespace Crowdproperty\CQRS\Commands\Banking;

use Crowdproperty\CQRS\Contracts\Command;
use Crowdproperty\CQRS\DTO\Banking\Transaction;

class WalletTransferCompleted implements Command
{
    public function __construct(
        public readonly string $walletUuid,
        public readonly Transaction $transaction,
    )
    {

    }
}
