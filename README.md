# St_ProductListBlockCache

## Description

A simple module that adds cache information to `Mage_Catalog_Block_Product_List` - thereby enabling block caching on 
product lists.

This module was created for a tutorial on [Minute.no](http://www.minute.no).
 
## Why would you install this?

Short answer:  
Better performance.

Medium answer:  
You might be familiar with Magento's block caching system. It is great. It works. Except it is barely enabled on a 
default installation of Magento.

One of the most resource intensive templates in Magento is the category page. The dominant block on most category 
pages is the product list block. Or `Mage_Catalog_Block_Product_List` to be precise.

This module overrides `Mage_Catalog_Block_Product_List` by adding some caching information which in turn will enable 
caching for product lists. The product prices will be correct no matter who is logged in.
 
## How much increase in performance can I expect?

On Enterprise Edition with full page caching enabled: __0__. Why? Because block caching is disabled while FPC is 
enabled.
 
On Community Edition: __2 x performance increase on cached category pages__

The results are highly unscientific and is based on loading the `accessories/shoes.html` page on a clean install of 
Magento 1.9.1 with Magento's sample data installed.

### Results from Blackfire.io

Here are the results from [Blackfire.io](https://blackfire.io/slots):

#### Cached category page

| Measurement | Module disabled | Module enabled | Diff. in % |  
| :---------- | --------------: | -------------: | ---------: |  
| [Wall Time](http://en.wikipedia.org/wiki/Wall-clock_time)   | 1 s             | 483 ms         | - 52 %     |  
| I/O         | 103 ms          | 27.8 ms        | - 73 %     |  
| CPU Time    | 900 ms          | 455 ms         | - 49 %     |  
| Memory      | 37.1 MB         | 33.4 MB        | - 10 %     |  

This means that - roughly - your site will be able to render twice as many category pages per minute if this module 
is enabled.
 
## Installation

### Using modman

Make sure you have [modman](https://github.com/colinmollenhour/modman).

```bash
$ cd /path/to/your/magento
$ modman clone https://github.com/siment/St_ProductListBlockCache.git
```

### Manual install

Download files and copy to your Magento root

## Changelog

### 0.1.7

Now supports language and currency switching:

1. Added locale code to cache key info
1. Added currency code to cache key info

### 0.1.6

1. Adding request URI to cache key to acommodate for filters and page numbers. It is not really that useful to have
category page caching persist across URIs. I might improve on this later.
1. Minor change to modman files.

### 0.1.5

1. Initial commit. Basic functionality in place.