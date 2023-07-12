<?php

namespace Tests\Unit;

use App\Enums\ItemStatsType;
use App\Repositories\Item\ItemRepository;
use Tests\TestCase;
use App\Services\ItemStatsService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemStatsTest extends TestCase
{
    use RefreshDatabase;

    private function createService(): ItemStatsService
    {
        return new ItemStatsService(new ItemRepository);
    }
    
    public function test_getting_all_stats()
    {
        $stats = $this->createService()->getItemStats(ItemStatsType::ALL);

        $this->assertIsInt($stats["total_count"]);
        $this->assertIsFloat($stats["avg_price"]);
        $this->assertIsString($stats["top_price_website"]);
        $this->assertIsNumeric($stats["total_price_this_month"]);
    }

    public function test_getting_total_count_only()
    {
        $result = $this->createService()->getItemStats(ItemStatsType::TOTAL_COUNT);

        $this->assertIsInt($result);
    }

    public function test_getting_avg_price_only()
    {
        $result = $this->createService()->getItemStats(ItemStatsType::AVG_PRICE);

        $this->assertIsFloat($result);
    }

    public function test_getting_top_price_website_only()
    {
        $result = $this->createService()->getItemStats(ItemStatsType::TOP_PRICE_WEBSITE);

        $this->assertIsString($result);
    }

    public function test_getting_total_price_this_month_only()
    {
        $result = $this->createService()->getItemStats(ItemStatsType::TOTAL_PRICE_THIS_MONTH);

        $this->assertIsNumeric($result);
    }

    public function test_it_throw_exception_if_the_type_not_matched()
    {
        $this->expectExceptionMessage("type not matched");

        $this->createService()->getItemStats(1000);
    }
}
