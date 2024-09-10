<?php

namespace Crowdproperty\CQRS\DTO\Banking;

use Crowdproperty\CQRS\DTO\DTO;
use Illuminate\Support\Carbon;

class WalletType extends DTO
{
    public function __construct(
        public readonly string $slug,
        public readonly string $name,
        public readonly Carbon|null $created_at,
        public readonly Carbon|null $updated_at,
        public readonly int|null $id = null,
    ) {

    }
}
