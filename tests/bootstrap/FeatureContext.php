<?php

namespace Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\TestCase as PhpUnit;
use Us\ProductFilter\Factory\ConditionOperatorSpecificationFactory;
use Us\ProductFilter\Factory\ProductPropertyExtractorFactory;
use Us\ProductFilter\Model\Product;
use Us\ProductFilter\Model\ProductFilter;
use Us\ProductFilter\Model\ProductFilterGroup;
use Us\ProductFilter\Model\ProductFilterGroupCondition;
use Us\ProductFilter\Model\ProductFilterInterface;
use Us\ProductFilter\Model\ProductInterface;
use Us\ProductFilter\ProductFilterMatcher;

class FeatureContext implements Context
{
    /**
     * @var ProductFilterMatcher
     */
    private $productMatcherService;

    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @var ProductFilterInterface
     */
    private $productFilter;

    /**
     * @var bool
     */
    private $matchResult;

    /**
     * @Given I have ProductFilterMatcher service
     */
    public function iHaveProductfiltermatcherService()
    {
        $this->productMatcherService = new ProductFilterMatcher(
            new ConditionOperatorSpecificationFactory(
                new ProductPropertyExtractorFactory()
            )
        );
    }

    /**
     * @Given /^I have empty ProductFilter with two groups$/
     */
    public function iHaveEmptyProductFilterWithTwoGroups()
    {
        $productFilter = new ProductFilter();
        $productFilter->setProductFilterGroups(new ProductFilterGroup(), new ProductFilterGroup());
        $this->productFilter = $productFilter;
    }

    /**
     * @Given There are next product properties:
     */
    public function thereAreNextProductProperties(TableNode $table)
    {
        $product = new Product;
        foreach ($table->getHash() as $settingRow) {
            switch ($settingRow['setting_name']) {
                case 'id':
                    $product->setId($settingRow['setting_value']);
                    break;
                case 'brandId':
                    $product->setBrandId($settingRow['setting_value']);
                    break;
                case 'categoryId':
                    $product->setCategoryId($settingRow['setting_value']);
                    break;
                case 'strainType':
                    $product->setStrainType($settingRow['setting_value']);
                    break;
            }
        }

        $this->product = $product;
    }

    /**
     * @Given /^There are next ProductFilter "(group1|group2)" settings:$/
     */
    public function thereAreNextProductfilterGroupSettings($groupName, TableNode $table)
    {
        $group = $groupName === 'group1'
            ? $this->productFilter->getProductFilterGroups()[0]
            : $this->productFilter->getProductFilterGroups()[1];

        $conditions = [];
        foreach ($table->getHash() as $conditionRow) {
            $condition = new ProductFilterGroupCondition();
            $condition->setType($conditionRow['type'])
                ->setOperator($conditionRow['operator'])
                ->setValue(json_decode($conditionRow['value']));
            $conditions[] = $condition;
        }
        $group->setProductFilterGroupConditions(...$conditions);
    }

    /**
     * @When I match product
     */
    public function iMatchProduct()
    {
        $this->matchResult = $this->productMatcherService->match($this->product, $this->productFilter);
    }

    /**
     * @Then the result of matching is :result
     */
    public function theResultOfMatchingIs($result)
    {
        PhpUnit::assertEquals($result, $this->matchResult);
    }

    /**
     * @Transform /^true$/
     */
    public function castTrueToBoolean($string): bool
    {
        return true;
    }

    /**
     * @Transform /^false$/
     */
    public function castFalseToBoolean($string): bool
    {
        return false;
    }

    /**
     * @Transform /^(\d+)$/
     */
    public function castStringToNumber($string): float
    {
        return (float) $string;
    }
}
