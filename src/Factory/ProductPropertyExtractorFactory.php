<?php

namespace Us\ProductFilter\Factory;

use LogicException;
use Us\ProductFilter\Model\ProductFilterGroupCondition;
use Us\ProductFilter\ProductPropertyExtractor\ProductBrandIdExtractor;
use Us\ProductFilter\ProductPropertyExtractor\ProductCategoryIdExtractor;
use Us\ProductFilter\ProductPropertyExtractor\ProductIdExtractor;
use Us\ProductFilter\ProductPropertyExtractor\ProductPropertyExtractorInterface;
use Us\ProductFilter\ProductPropertyExtractor\ProductStrainTypeExtractor;
use Us\ProductFilter\ProductPropertyExtractor\ProductTagExtractor;
use Us\ProductFilter\ProductPropertyExtractor\ProductVendorExtractor;

class ProductPropertyExtractorFactory
{
    private const TYPE_PRODUCT_CATEGORY = 'product_category';
    private const TYPE_BRAND            = 'brand';
    private const TYPE_STRAIN_TYPE      = 'strain_type';
    private const TYPE_PRODUCT          = 'product';
    private const TYPE_PRODUCT_TAG      = 'product_tag';
    private const TYPE_VENDOR           = 'vendor';

    public function create(ProductFilterGroupCondition $condition): ProductPropertyExtractorInterface
    {
        switch ($condition->getType()) {
            case self::TYPE_PRODUCT_CATEGORY:
                return new ProductCategoryIdExtractor();
            case self::TYPE_BRAND:
                return new ProductBrandIdExtractor();
            case self::TYPE_STRAIN_TYPE:
                return new ProductStrainTypeExtractor();
            case self::TYPE_PRODUCT:
                return new ProductIdExtractor();
            case self::TYPE_PRODUCT_TAG:
                return new ProductTagExtractor();
            case self::TYPE_VENDOR:
                return new ProductVendorExtractor();
            default:
                throw new LogicException('Unsupported product filter condition type, called in ConditionOperatorSpecificationFactory');
        }
    }
}
