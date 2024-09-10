<?php

namespace Crowdproperty\CQRS\Commands\Banking;

use Crowdproperty\CQRS\Contracts\Command;

class WalletCreated implements Command
{
    public function __construct(
        public readonly string $walletUuid,
    )
    {

    }
}
