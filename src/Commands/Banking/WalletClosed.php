<?php

namespace Crowdproperty\CQRS\Commands\Banking;

use Crowdproperty\CQRS\Contracts\Command;

class WalletClosed implements Command
{
    public function __construct(
        public readonly string $walletUuid,
    )
    {

    }
}
