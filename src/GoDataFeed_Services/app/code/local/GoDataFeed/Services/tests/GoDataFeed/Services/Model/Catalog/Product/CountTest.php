<?php
/**
 * Copyright 2019 Method Merchant, LLC or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 *  http://aws.amazon.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */
/**
 * Class GoDataFeed_Services_Model_Catalog_Product_CountTest.
 * @package GoDataFeed_Services
 * @author yvechirko
 */
class GoDataFeed_Services_Model_Catalog_Product_CountTest
    extends GoDataFeed_Services_Model_Catalog_Product_AbstractBaseProductsData
{
    /**
     * Set tested object.
     *
     * @return void
     */
    protected function setTestedObject()
    {
        $this->testedObject = Mage::getModel('godatafeed_services/catalog_product_count');
    }

    /**
     * Testing of the class.
     *
     * @return void
     */
    public function testTestedObjectClass()
    {
        $this->assertInstanceOf(
                GoDataFeed_Services_Model_Catalog_Product_Count::class,
                $this->testedObject
            );
    }

    /**
     * Creating the stub object.
     *
     * @return PHPUnit\Framework\MockObject\MockObject
     */
    protected function getCollectionStub()
    {
        $stub = $this->getMockBuilder(
                get_class(Mage::getModel('catalog/product')->getCollection())
            )->setMethods(array('getSize'))
            ->getMock();
        $stub->method('getSize')
             ->willReturn(GoDataFeed_Services_Model_Catalog_Product_DataForTesting::COUNT_TEST_RESULT);

        return $stub;
    }

    /**
     * Checking the method.
     *
     * @return void
     */
    public function testCount()
    {
        $result = $this->testedObject
            ->count(
                GoDataFeed_Services_Model_Catalog_Product_DataForTesting::FILTERS,
                GoDataFeed_Services_Model_Catalog_Product_DataForTesting::QUANTITY_FILTER_AMOUNT,
                GoDataFeed_Services_Model_Catalog_Product_DataForTesting::getDefaultStoreId()
            );

        $this->assertEquals(GoDataFeed_Services_Model_Catalog_Product_DataForTesting::COUNT_TEST_RESULT, $result);

        $this->checkCollection();

    }

    /**
     * Test the collection.
     *
     * @return void
     */
    protected function checkCollection()
    {
        $collection = $this->testedObject->getProductCollection();

        $this->checkCollectionClass($collection);
        $this->checkCollectionStoreFilter($collection);
        $this->checkQtyFilter($collection);
        $this->checkFilters($collection);
    }
}
