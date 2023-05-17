<?php

namespace Us\ProductFilter\ProductPropertyExtractor;

use Us\ProductFilter\Model\ProductInterface;

class ProductVendorExtractor implements ProductPropertyExtractorInterface
{
    public function extract(ProductInterface $product): array
    {
        return (array) $product->getVendorIds();
    }
}