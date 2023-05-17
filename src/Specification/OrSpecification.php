<?php

namespace Us\ProductFilter\Specification;

use Us\ProductFilter\Model\ProductInterface;

class OrSpecification implements SpecificationInterface
{
    /**
     * @var SpecificationInterface[]
     */
    private $specifications;

    /**
     * @param SpecificationInterface[] $specifications
     */
    public function __construct(SpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
    }

    public function isSatisfiedBy(ProductInterface $product): bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($product)) {
                return true;
            }
        }

        return false;
    }
}
