<?php

namespace Crowdproperty\CQRS\DTO\Banking;

use Crowdproperty\CQRS\DTO\DTO;
use Illuminate\Support\Carbon;

class WalletSettings extends DTO
{
    public function __construct(
        public readonly Wallet $wallet,
        public readonly bool $autoinvest,
        public readonly bool $autoinvest_enabled,
        public readonly bool $skip_wallet,
        public readonly float $maximum_pledge_size,
        public readonly Carbon|null $no_funds_email_sent_date,
        public readonly Carbon|null $top_up_email_sent_date,
        public readonly Carbon|null $created_at,
        public readonly Carbon|null $updated_at,
        public readonly int|null $id = null,
    )
    {

    }
}
