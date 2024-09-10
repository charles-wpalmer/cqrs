<?php

namespace Crowdproperty\CQRS\Commands\Banking;

use Crowdproperty\CQRS\Contracts\Command;
use Crowdproperty\CQRS\DTO\Banking\Wallet;

class WalletTransfer implements Command
{
    public function __construct(
        public readonly string $toWalletUuid,
        public readonly string $fromWalletUuid,
        public readonly int $amount,
        public readonly string $reference,
    )
    {

    }
}
