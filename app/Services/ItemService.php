<?php

namespace App\Services;

use App\Models\Item;
use App\Serializers\ItemSerializer;
use App\Serializers\ItemsSerializer;
use League\CommonMark\CommonMarkConverter;

class ItemService
{
    public function index()
    {
        $items = Item::all();

        return (new ItemsSerializer($items))->getData();
    }

    public function store(array $data)
    {
        $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

        $item = Item::create([
            'name' => $data["name"],
            'price' => $data["price"],
            'url' => $data["url"],
            'description' => $converter->convert($data["description"])->getContent(),
        ]);

        $serializer = new ItemSerializer($item);

        return $serializer->getData();
    }

    public function show(int $id)
    {
        $item = Item::findOrFail($id);

        $serializer = new ItemSerializer($item);

        return $serializer->getData();
    }

    public function update(array $data, int $id)
    {
        $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

        $item = Item::findOrFail($id);
        $item->name = $data["name"];
        $item->url = $data["url"];
        $item->price = $data["price"];
        $item->description = $converter->convert($data["description"])->getContent();
        $item->save();

        return (new ItemSerializer($item))->getData();
    }
}
