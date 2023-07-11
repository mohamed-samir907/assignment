<?php

namespace App\Repositories\Item;

use App\Models\Item;
use App\DTOs\ItemData;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Item\ItemRepositoryInterface;

class ItemRepository implements ItemRepositoryInterface
{
    public function all(): Collection
    {
        return Item::all(["id", "name", "price", "url", "description"]);
    }

    public function findOrFail(int $id): ?Item
    {
        return Item::query()->findOrFail($id);
    }

    public function create(ItemData $data): Item
    {
        return Item::query()->create([
            'name'          => $data->getName(),
            'price'         => $data->getPrice(),
            'url'           => $data->getUrl(),
            'description'   => $data->getDescription(),
        ]);
    }

    public function update(Item $item, ItemData $data): bool
    {
        return $item->update([
            'name'          => $data->getName(),
            'price'         => $data->getPrice(),
            'url'           => $data->getUrl(),
            'description'   => $data->getDescription(),
        ]);
    }

    public function totalCount(): int
    {
        return Item::count();
    }

    public function avgPrice(): float
    {
        return Item::avg("price") ?? 0;
    }

    public function topPriceWebsite(): string
    {
        return DB::table("items")
            ->selectRaw('
                SUBSTRING_INDEX(SUBSTRING_INDEX(url, "://", -1), "/", 1) domain,
                SUM(price) sum_price
            ')
            ->groupBy("domain")
            ->orderByDesc("sum_price")
            ->first()?->domain ?? "";
    }

    public function periodTotalPrice(string $startDate, string $endDate): float
    {
        return Item::whereBetween("created_at", [$startDate, $endDate])->sum("price") ?? 0;
    }
}
