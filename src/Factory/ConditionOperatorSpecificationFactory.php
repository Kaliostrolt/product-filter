<?php

namespace Us\ProductFilter\Factory;

use Us\ProductFilter\Model\ProductFilterGroupCondition;
use Us\ProductFilter\Specification\InSpecification;
use Us\ProductFilter\Specification\NotInSpecification;
use Us\ProductFilter\Specification\SpecificationInterface;

class ConditionOperatorSpecificationFactory
{
    private const OPERATOR_IN     = 'in';
    private const OPERATOR_NOT_IN = 'not_in';

    /**
     * @var ProductPropertyExtractorFactory
     */
    private $productPropertyExtractorFactory;

    public function __construct(ProductPropertyExtractorFactory $productPropertyExtractorFactory)
    {
        $this->productPropertyExtractorFactory = $productPropertyExtractorFactory;
    }

    public function create(ProductFilterGroupCondition $condition): SpecificationInterface
    {
        $productPropertyExtractor = $this->productPropertyExtractorFactory->create($condition);
        if ($condition->getOperator() === self::OPERATOR_IN) {
            return new InSpecification($productPropertyExtractor, $condition->getValue());
        }

        if ($condition->getOperator() === self::OPERATOR_NOT_IN) {
            return new NotInSpecification($productPropertyExtractor, $condition->getValue());
        }
    }
}
