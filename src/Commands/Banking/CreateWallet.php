<?php

namespace Crowdproperty\CQRS\Commands\Banking;

use Crowdproperty\CQRS\Contracts\Command;
use Crowdproperty\CQRS\DTO\Banking\Wallet;

class CreateWallet implements Command
{
    public function __construct(
        public readonly Wallet $wallet,
    )
    {

    }
}
