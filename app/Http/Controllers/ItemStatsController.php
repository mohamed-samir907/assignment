<?php

namespace App\Http\Controllers;

use App\Services\ItemStatsService;

class ItemStatsController extends Controller
{
    private ItemStatsService $itemStatsService;

    public function __construct(ItemStatsService $itemStatsService)
    {
        $this->itemStatsService = $itemStatsService;
    }

    public function __invoke()
    {
        return $this->itemStatsService->getItemStats();
    }
}
