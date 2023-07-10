<?php

namespace App\Services;

use App\DTOs\ItemData;
use App\Http\Resources\ItemResource;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Repositories\Item\ItemRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemService
{
    private ItemRepositoryInterface $repo;
    private CommonMarkConverter $converter;

    public function __construct(
        ItemRepositoryInterface $repo,
        CommonMarkConverter $converter
    ) {
        $this->repo = $repo;
        $this->converter = $converter;
    }

    public function index(): ResourceCollection
    {
        $items = $this->repo->all();

        return ItemResource::collection($items);
    }

    public function store(array $data): JsonResource
    {
        $dto = new ItemData(
            name: $data["name"],
            price: $data["price"],
            url: $data["url"],
            description: $this->converter->convert($data["description"])->getContent()
        );

        $item = $this->repo->create($dto);

        return new ItemResource($item);
    }

    public function show(int $id): JsonResource
    {
        $item = $this->repo->findOrFail($id);

        return new ItemResource($item);
    }

    public function update(array $data, int $id): JsonResource
    {
        $item = $this->repo->findOrFail($id);

        $dto = new ItemData(
            name: $data["name"],
            price: $data["price"],
            url: $data["url"],
            description: $this->converter->convert($data["description"])->getContent()
        );

        $this->repo->update($item, $dto);

        return new ItemResource($item);
    }
}
