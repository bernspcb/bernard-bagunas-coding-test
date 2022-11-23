<?php

declare(strict_type=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    private ?int $id;
    private string $name;
    private string $description;
    private float $price;
    private string $createdAt;
    private string $updatedAt;

    function __construct(
        ?int $id,
        string $name,
        string $description,
        float $price,
        string $createdAt,
        string $updatedAt
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getPrice() : float
    {
        return $this->price;
    }

    public function getcreatedAt() : string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt() : string
    {
        return $this->updatedAt;
    }

    public function toArray() : array{
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'createdAt'   => $this->createdAt,
            'updatedAt'   => $this->updatedAt
        ];
    }

    public function toSQL() : array{
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'created_at'  => $this->createdAt,
            'updated_at'  => $this->updatedAt
        ];
    }
}
