<?php

namespace App\Repositories\Item;

use App\Models\Item;
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

    public function create(array $data): Item
    {
        return Item::query()->create([
            'name'          => $data["name"],
            'price'         => $data["price"],
            'url'           => $data["url"],
            'description'   => $data["description"],
        ]);
    }

    public function update(Item $item, array $data): bool
    {
        return $item->update([
            'name'          => $data["name"],
            'price'         => $data["price"],
            'url'           => $data["url"],
            'description'   => $data["description"],
        ]);
    }
}
