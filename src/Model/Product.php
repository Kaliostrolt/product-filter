<?php

namespace Us\ProductFilter\Model;

class Product implements ProductInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $categoryId;

    /**
     * @var int
     */
    private $brandId;

    /**
     * @var int
     */
    private $strainType;

    /**
     * @var array|int[]
     */
    private $tagIds;

    /**
     * @var array|int[]
     */
    private $vendorIds;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getBrandId(): int
    {
        return $this->brandId;
    }

    public function getStrainType(): int
    {
        return $this->strainType;
    }

    public function getTagIds(): array
    {
        return $this->tagIds;
    }

    public function getVendorIds(): array
    {
        return $this->vendorIds;
    }

    public function setId(int $id): ProductInterface
    {
        $this->id = $id;

        return $this;
    }

    public function setCategoryId(int $categoryId): ProductInterface
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function setBrandId(int $brandId): ProductInterface
    {
        $this->brandId = $brandId;

        return $this;
    }

    public function setStrainType(int $strainType): ProductInterface
    {
        $this->strainType = $strainType;

        return $this;
    }

    public function setTagIds(array $tagIds): ProductInterface
    {
        $this->tagIds = $tagIds;

        return $this;
    }

    public function setVendorIds(array $vendorIds): ProductInterface
    {
        $this->vendorIds = $vendorIds;

        return $this;
    }
}
