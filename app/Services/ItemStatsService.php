<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use App\Enums\ItemStatsType;
use App\Repositories\Item\ItemRepositoryInterface;

class ItemStatsService
{
    private ItemRepositoryInterface $repo;

    public function __construct(ItemRepositoryInterface $repo,)
    {
        $this->repo = $repo;
    }

    public function getItemStats(int $type = ItemStatsType::ALL): mixed
    {
        $start = Carbon::now()->firstOfMonth()->format("Y-m-d 00:00:00");
        $end = Carbon::now()->endOfMonth()->format("Y-m-d 23:59:59");

        return match($type) {
            ItemStatsType::ALL => [
                "total_count"       => $this->repo->totalCount(),
                "avg_price"         => $this->repo->avgPrice(),
                "top_price_website" => $this->repo->topPriceWebsite(),
                "total_price_this_month" => $this->repo->periodTotalPrice($start, $end),
            ],
            ItemStatsType::TOTAL_COUNT          => $this->repo->totalCount(),
            ItemStatsType::AVG_PRICE            => $this->repo->avgPrice(),
            ItemStatsType::TOP_PRICE_WEBSITE    => $this->repo->topPriceWebsite(),
            ItemStatsType::TOTAL_PRICE_THIS_MONTH => $this->repo->periodTotalPrice($start, $end),
            default => throw new Exception("type not matched"),
        };
    }
}
