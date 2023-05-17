<?php

namespace Us\ProductFilter\Model;

class ProductFilterGroupCondition
{
    /**
     * @var string
     * enum[product_category, brand, strain_type, product]
     */
    private $type;

    /**
     * @var string
     * enum[in, not_in]
     */
    private $operator;

    /**
     * @var array
     */
    private $value;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function getOperator(): string
    {
        return $this->operator;
    }

    public function getValue(): array
    {
        return $this->value;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setOperator(string $operator): self
    {
        $this->operator = $operator;

        return $this;
    }

    public function setValue(array $value): self
    {
        $this->value = $value;

        return $this;
    }
}
