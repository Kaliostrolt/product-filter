<?php

namespace Us\ProductFilter\ProductPropertyExtractor;

use Us\ProductFilter\Model\ProductInterface;

interface ProductPropertyExtractorInterface
{
    /**
     * @param ProductInterface $product
     * @return int|array
     */
    public function extract(ProductInterface $product);
}
