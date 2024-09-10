<?php

namespace Crowdproperty\CQRS;

use Crowdproperty\CQRS\Contracts\Command;

class AggregateRoot extends \Spatie\EventSourcing\AggregateRoots\AggregateRoot
{
    public function handle(Command $command): mixed
    {
        $parts = explode('\\', $command::class);

        return $this->{'handle' . end($parts)}($command);
    }
}
