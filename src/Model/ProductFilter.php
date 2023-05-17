<?php

namespace Us\ProductFilter\Model;

class ProductFilter implements ProductFilterInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ProductFilterGroup[]
     */
    private $productFilterGroups;

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ProductFilterGroup[]
     */
    public function getProductFilterGroups(): array
    {
        return $this->productFilterGroups;
    }

    public function setProductFilterGroups(ProductFilterGroup ...$filterGroups): ProductFilterInterface
    {
        $this->productFilterGroups = $filterGroups;

        return $this;
    }
}
