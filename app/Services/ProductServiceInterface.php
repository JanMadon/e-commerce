<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function getAllProductsWithMainPhotos();
    public function getProduct(int $id);
    public function saveProduct(array $data, array $photos);
    public function updateValue(int $productId, string $type, $value);
}
