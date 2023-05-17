<?php

namespace Us\ProductFilter\Model;

interface ProductFilterInterface
{
    /**
     * @return ProductFilterGroup[]
     */
    public function getProductFilterGroups(): array;

    public function setProductFilterGroups(ProductFilterGroup ...$filterGroups): self;
}
