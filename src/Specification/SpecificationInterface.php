<?php

namespace Us\ProductFilter\Specification;

use Us\ProductFilter\Model\ProductInterface;

interface SpecificationInterface
{
    public function isSatisfiedBy(ProductInterface $product): bool;
}
