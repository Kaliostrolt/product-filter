<?php

namespace Us\ProductFilter\Specification;

use Us\ProductFilter\Model\ProductInterface;
use Us\ProductFilter\ProductPropertyExtractor\ProductPropertyExtractorInterface;

class InSpecification implements SpecificationInterface
{
    /**
     * @var ProductPropertyExtractorInterface
     */
    private $extractor;

    /** @var array */
    private $haystack;

    public function __construct(ProductPropertyExtractorInterface $extractor, array $haystack)
    {
        $this->extractor = $extractor;
        $this->haystack = $haystack;
    }

    public function isSatisfiedBy(ProductInterface $product): bool
    {
        $property = $this->extractor->extract($product);
        if (is_array($property)) {
            return !empty(array_intersect($property, $this->haystack));
        }

        return in_array($property, $this->haystack, true);
    }
}
