<?php

namespace Us\ProductFilter\ProductPropertyExtractor;

use Us\ProductFilter\Model\ProductInterface;

class ProductCategoryIdExtractor implements ProductPropertyExtractorInterface
{
    public function extract(ProductInterface $product): int
    {
        return $product->getCategoryId();
    }
}
