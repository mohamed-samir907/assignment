<?php

namespace App\Repositories\Item;

use App\Models\Item;
use App\DTOs\ItemData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface ItemRepositoryInterface
{
    /**
     * Retrive all the items at once.
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Retrive a single item or fails.
     *
     * @param  int $id
     * @return Item|null
     * 
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $id): ?Item;

    /**
     * Create new Item.
     *
     * @param  ItemData $data
     * @return Item
     */
    public function create(ItemData $data): Item;

    /**
     * Update an existing item.
     *
     * @param  Item $item
     * @param  ItemData $data
     * @return bool
     */
    public function update(Item $item, ItemData $data): bool;
}
