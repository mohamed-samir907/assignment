<?php

namespace App\Console\Commands;

use App\Services\ItemStatsService;
use Illuminate\Console\Command;

class ItemStatsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'item:stats 
                            {--type= : Can be >> 0 : all, 1 : total_count, 2 : avg_price, 3 : top_price_website, 4 : total_price_this_month}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Item Statistics';

    private array $types = [
        1 => "total_count",
        2 => "avg_price",
        3 => "top_price_website",
        4 => "total_price_this_month",
    ];

    private ItemStatsService $itemStatsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ItemStatsService $itemStatsService)
    {
        parent::__construct();
        $this->itemStatsService = $itemStatsService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->option("type") ?? 0;

        $result = $this->itemStatsService->getItemStats($type);

        if (is_array($result)) {
            $result = collect($result)->map(function ($value, $type) {
                return [
                    "type" => $type,
                    "value" => $value
                ];
            })->values()->toArray();
        } else {
            $result = [
                [
                    "type" => $this->types[$type],
                    "value" => $result,
                ]
            ];
        }

        $this->table(["type", "value"], $result);
    }
}
