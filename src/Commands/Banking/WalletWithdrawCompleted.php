<?php

namespace Crowdproperty\CQRS\Commands\Banking;

use Crowdproperty\CQRS\Contracts\Command;
use Crowdproperty\CQRS\DTO\Banking\Transaction;

class WalletWithdrawCompleted implements Command
{
    public function __construct(
        public readonly string $walletUuid,
        public readonly Transaction $transaction,
    )
    {

    }
}
