<?php

namespace Crowdproperty\CQRS\DTO\Banking;

use Crowdproperty\CQRS\DTO\DTO;
use Illuminate\Support\Carbon;

class Wallet extends DTO
{
    public function __construct(
        public readonly int $user_id,
        public readonly int|null $accessor_id,
        public readonly int|null $bank_account_id,
        public readonly string $provider,
        public readonly string|null $provider_id,
        public readonly string $name,
        public readonly int $balance,
        public readonly int $available_balance,
        public readonly WalletType $wallet_type,
        public readonly Carbon|null $closed_at,
        public readonly Carbon|null $created_at,
        public readonly Carbon|null $updated_at,
        public readonly int|null $id = null,
        public readonly string|null $uuid = null,
    ) {
        //
    }
}
