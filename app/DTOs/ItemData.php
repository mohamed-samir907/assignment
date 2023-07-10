<?php

namespace App\DTOs;

class ItemData
{
    public function __construct(
        private string $name,
        private float $price,
        private string $url,
        private string $description,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
