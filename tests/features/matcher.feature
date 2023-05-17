Feature: We need to test product matching according to product filter settings
  All of conditions inside group should work according to logic 'and' and between groups
  according to logic 'or'

  Background:
    Given I have ProductFilterMatcher service
    And I have empty ProductFilter with two groups

  Scenario Outline: We need to prepare product filter conditions and product object
    Given There are next product properties:
      | setting_name | setting_value |
      | id           | 1             |
      | brandId      | 2             |
      | categoryId   | 3             |
      | strainType   | 1             |
    And There are next ProductFilter "group1" settings:
      | type  | operator | value   |
      | <11t> | <11op>   | <11val> |
      | <12t> | <12op>   | <12val> |
    And There are next ProductFilter "group2" settings:
      | type  | operator | value   |
      | <21t> | <21op>   | <21val> |
      | <22t> | <22op>   | <22val> |
    When I match product
    Then the result of matching is "<res>"

    Examples:
      | 11t              | 11op | 11val | 12t     | 12op | 12val | 21t         | 21op   | 21val | 22t   | 22op   | 22val | res   |
      # one match in the first group
      | product_category | in   | [1,3] | product | in   | [3,4] | strain_type | not_in | [1]   | brand | not_in | [2]   | false |
      | product_category | in   | [1,2] | product | in   | [1,4] | strain_type | not_in | [1]   | brand | not_in | [2]   | false |
      # one match in the second one
      | product_category | in   | [2,4] | product | in   | [2,4] | strain_type | not_in | [2]   | brand | not_in | [2]   | false |
      | product_category | in   | [2,4] | product | in   | [2,4] | strain_type | not_in | [1]   | brand | not_in | [3]   | false |
      # two match in the first group
      | product_category | in   | [1,3] | product | in   | [1,4] | strain_type | not_in | [1]   | brand | not_in | [2]   | true  |
      # two match in the second one
      | product_category | in   | [1,5] | product | in   | [3,4] | strain_type | not_in | [2]   | brand | not_in | [3]   | true  |
