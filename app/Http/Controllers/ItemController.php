<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    private ItemService $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        $items = $this->itemService->index();

        return response()->json(["items" => $items]);
    }

    public function store(ItemRequest $request)
    {
        $item = $this->itemService->store($request->validated());

        return response()->json(["item" => $item]);
    }

    public function show($id)
    {
        $item = $this->itemService->show($id);

        return response()->json(["item" => $item]);
    }

    public function update(ItemRequest $request, int $id): JsonResponse
    {
        $item = $this->itemService->update($request->validated(), $id);

        return response()->json(["item" => $item]);
    }
}
