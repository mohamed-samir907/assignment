<?php

namespace App\Services;

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
        $data["description"] = $this->converter->convert($data["description"])->getContent();

        $item = $this->repo->create($data);

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

        $data["description"] = $this->converter->convert($data["description"])->getContent();

        $this->repo->update($item, $data);

        return new ItemResource($item);
    }
}
