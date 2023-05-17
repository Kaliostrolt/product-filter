<?php

namespace Us\ProductFilter\Model;

class ProductFilterGroup
{
    /**
     * @var ProductFilterGroupCondition[]
     */
    private $productFilterGroupConditions;

    /**
     * @return ProductFilterGroupCondition[]
     */
    public function getProductFilterGroupConditions(): array
    {
        return $this->productFilterGroupConditions;
    }

    public function setProductFilterGroupConditions(ProductFilterGroupCondition ...$conditions): self
    {
        $this->productFilterGroupConditions = $conditions;

        return $this;
    }
}
