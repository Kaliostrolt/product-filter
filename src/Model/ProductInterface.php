<?php

namespace Us\ProductFilter\Model;

interface ProductInterface
{
    public function getId(): int;

    public function getCategoryId(): int;

    public function getBrandId(): int;

    public function getStrainType(): int;

    public function getTagIds(): array;

    public function getVendorIds(): array;
}
