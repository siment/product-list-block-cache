<?php
/**
 * The MIT License (MIT)
 *
 * Copyright (c) 2015 Simen Thorsrud
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @category    St
 * @package     St_ProductListBlockCache
 * @author      Simen Thorsrud <simen.thorsrud@gmail.com>
 * @license     http://opensource.org/licenses/MIT The MIT License (MIT)
 */

/**
 * Class St_ProductListBlockCache_Block_Catalog_Product_List
 *
 * Extends standard product list block and adds cache details to enable product list block caching
 *
 * @see Mage_Catalog_Block_Product_List
 */
class St_ProductListBlockCache_Block_Catalog_Product_List extends Mage_Catalog_Block_Product_List
{

    /** Default cache lifetime in seconds. (86400 = 24 hours) */
    const DEFAULT_CACHE_LIFETIME = 86400;

    /**
     * Returns array that uniquely identifies this product list in cache storage
     *
     * I have added the array keys: category_id, customer_group and website_id to ensure that we get correct product
     * prices in every instance of this product list
     *
     * @return array Cache key info
     * @throws Mage_Core_Exception
     */
    public function getCacheKeyInfo()
    {
        // Get Magento's standard product list block cache key info
        $info = parent::getCacheKeyInfo();

        /** @var Mage_Catalog_Model_Category|null $currentCategory Current category model or null */
        $currentCategory = Mage::registry('current_category');

        /** @var string $categoryId Current category id. Empty string if we don't know. */
        $categoryId = '';

        // If we know current category, then add category id to cache key info
        if ($currentCategory instanceof Mage_Catalog_Model_Category) {
            $categoryId = $currentCategory->getId();
        }

        // Add category_id to cache key info
        $info['category_id'] = $categoryId;

        /** @var int $customerGroupId Get logged in user's customer group id */
        $customerGroupId = (int) Mage::getSingleton('customer/session')->getCustomerGroupId();

        // Add customer_group to cache key info
        $info['customer_group'] = $customerGroupId;

        /** @var int $currentWebsiteId Current website ID */
        $currentWebsiteId = (int) Mage::app()->getWebsite()->getId();

        // Add website_id to cache key info
        $info['website_id'] = $currentWebsiteId;
        return $info;
    }

    /**
     * Returns cache lifetime in seconds
     *
     * @return int Longevity of cache key in seconds
     */
    public function getCacheLifetime()
    {
        return self::DEFAULT_CACHE_LIFETIME;
    }
}
