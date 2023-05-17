<?php

namespace Us\ProductFilter;

use Us\ProductFilter\Factory\ConditionOperatorSpecificationFactory;
use Us\ProductFilter\Model\ProductFilterInterface;
use Us\ProductFilter\Model\ProductInterface;
use Us\ProductFilter\Specification\AndSpecification;
use Us\ProductFilter\Specification\OrSpecification;

class ProductFilterMatcher
{
    /**
     * @var ConditionOperatorSpecificationFactory
     */
    private $conditionOperatorSpecificationFactory;

    public function __construct(ConditionOperatorSpecificationFactory $conditionOperatorSpecificationFactory)
    {
        $this->conditionOperatorSpecificationFactory = $conditionOperatorSpecificationFactory;
    }

    public function match(ProductInterface $product, ProductFilterInterface $productFilter): bool
    {
        $groupSpecifications = [];
        foreach ($productFilter->getProductFilterGroups() as $group) {
            $conditionSpecifications = [];
            foreach ($group->getProductFilterGroupConditions() as $condition) {
                $conditionSpecifications[] = $this->conditionOperatorSpecificationFactory->create($condition);
            }
            if ($conditionSpecifications) {
                $groupSpecifications[] = new AndSpecification(...$conditionSpecifications);
            }
        }

        return (new OrSpecification(...$groupSpecifications))->isSatisfiedBy($product);
    }
}
