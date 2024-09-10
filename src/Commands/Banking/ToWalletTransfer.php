<?php

namespace Crowdproperty\CQRS\Commands\Banking;

use Crowdproperty\CQRS\Contracts\Command;
use Crowdproperty\CQRS\DTO\Banking\Wallet;

class ToWalletTransfer implements Command
{
    public function __construct(
        public readonly string $walletUuid,
        public readonly int $amount,
        public readonly string $reference,
    )
    {

    }
}
