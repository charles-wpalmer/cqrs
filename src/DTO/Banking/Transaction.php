<?php

namespace Crowdproperty\CQRS\DTO\Banking;

use Crowdproperty\CQRS\DTO\DTO;
use Illuminate\Support\Carbon;

class Transaction extends DTO
{
    public function __construct(
        public readonly int $user_id,
        public readonly Wallet $wallet,
        public readonly string $provider,
        public readonly string $type,
        public readonly string $target_type,
        public readonly int $target_type_id,
        public readonly int $amount,
        public readonly int $currency_id,
        public readonly string $status,
        public readonly Carbon|null $processed_date = null,
        public readonly Carbon|null $completed_date = null,
        public readonly Carbon|null $failed_date = null,
        public readonly Carbon|null $updated_at = null,
        public readonly Carbon|null $created_at = null,
        public readonly int|null $id = null,
    ) {

    }
}
