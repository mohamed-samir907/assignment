<?php

namespace App\Services;

use App\Serializers\ItemSerializer;
use App\Serializers\ItemsSerializer;
use League\CommonMark\CommonMarkConverter;
use App\Repositories\Item\ItemRepositoryInterface;

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

    public function index()
    {
        $items = $this->repo->all();

        return (new ItemsSerializer($items))->getData();
    }

    public function store(array $data)
    {
        $data["description"] = $this->converter->convert($data["description"])->getContent();

        $item = $this->repo->create($data);

        $serializer = new ItemSerializer($item);

        return $serializer->getData();
    }

    public function show(int $id)
    {
        $item = $this->repo->findOrFail($id);

        $serializer = new ItemSerializer($item);

        return $serializer->getData();
    }

    public function update(array $data, int $id)
    {
        $item = $this->repo->findOrFail($id);

        $data["description"] = $this->converter->convert($data["description"])->getContent();

        $this->repo->update($item, $data);

        return (new ItemSerializer($item))->getData();
    }
}
