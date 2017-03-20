layout: true
<div class="slide-heading">Magento 2 for all of us</div>
<div class="slide-footer">
    <span>Magento 2 for all of us - Jisse Reitsma - slides.yireo.com</span>
</div>

---
class: center, middle, orange
# So ... Magento 2?

---
class: center, middle
# Aargghh, Magento !!

---
# Jisse Reitsma

--
- Yireo: Extension provider since 2009

--
- Trainer for M1 & M2 developers

--
- Magento Master "Mover" 2017

--
- Zend Z-Team member

--
- Organizing usergroups & hackathons & events

---
class: center, middle, orange
# Magento ...

---
class: center, middle
# Aargghh
### Magento is slow!!

---
# Example Magento shop
- "Help, my shop is slow"
    - 4.000 SKUs
    - 4 Gb RAM
    - Magento specialized hosting

---
# Example Magento shop
- "Help, my shop is slow"
- First glance (Oct 2016)
    - 4.000 Configurable Products
    - 4 million Simple Products
    - Server without SSD and still on PHP 5.3

---
# Example Magento shop
- "Help, my shop is slow"
- First glance
- Second glance
    - Outdated environment
    - No budget
    - No developer involved

---
# Magento performance
- Fast server with sufficient RAM and SSD
- Nginx, PHP-FPM, PHP 7
- Redis, memcache (sessions and cache)
- Optimized MySQL (Percona, InnoDB tuning)
- Optionally Varnish

---
class: center, middle
# Don't argue here
### Choose the right environment

---
class: center, middle
# Aargghh
### Magento is complex!!

---
# Magento complexity
- XML configuration
- Product Types: Configurable, Bundled, Grouped
- XML Layout and PHTML templating
- Multistore, multisite, multilingual

---
# Magento tools
- PhpStorm + Magicento plugin
- magerun CLI tool
- New Relic, Blackfire, Zend Z-Ray

---
# Alternatives
- Prestashop
- WooCommerce
- Thelia
- Sylius
- Sellvana

---
class: center, middle, orange
## Magento 2

---
# Why Magento 2?
- Released november 2015
- Complete rewrite of Magento 1
- Modern PHP architecture
    - DI, composer, PSR
- More extensible than Magento 1

---
class: center, middle
## Still slow?

---
## Magento 2 performance

--
- Code compilation

--
- Static file deployment

--
- jQuery versus Prototype

--
- Varnish integration

--
- Confusing benchmarks

---
class: center, middle
## Still complex?

---
## Magento 2 complexity
- Dependency Injection
- Composer
- RequireJS, KnockoutJS, UIComponents
- Code compilation
- Static file deployment

---
class: center, middle
## Still Magento

---
## Magento 2 DI
- Dependency Injection
- Object Manager (DI Container)
- Configurable via XML
    - Preferences, types, virtual types
    - Factories, builders, proxies
    - Plugins / interceptors

---
## Magento 2 Interceptors
- Middleware in Magento 2
    - Original class
    - Plugin class
    - Results in interceptor class
- Based on DI and code compilation

---
# Interceptors (1/3)
`etc/di.xml` (Yireo_FooBar module):
```xml
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:noNamespaceSchemaLocation="urn:magento:framework:
ObjectManager/etc/config.xsd">
    <type name="Magento\Catalog\Model\Product">
        <plugin name="uniqueFoobarName"
            type="Yireo\FooBar\Plugin\Catalog\ProductPlugin"
            sortOrder="1" disabled="false"/>
    </type>
</config>
```

---
# Interceptors (2/3)
`Magento\Catalog\Model\Product.php` (core):
```php
&lt;?php
namespace Magento\Catalog\Model;

class Product
{
    ...
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
    ...
}
```

---
# Interceptors (3/3)
File `Plugin\Catalog\ProductPlugin.php` (Yireo_FooBar module):

```php
&lt;?php
namespace Yireo\FooBar\Plugin\Catalog;
use Magento\Catalog\Model\Product;

class ProductPlugin
{
    public function beforeSetName(Product $subject, $name)
    {
        $name = trim($name);
        return array($name);
    }
}
```

---
## Complex?
- Build anything you want
- Customizable and reusable code
- Requires a learning curve

---
## Magento 2 composer
- GitHub releases
- Satis, Toran Proxy
- Integration of common packages
    - PSR, Monolog
    - oyejorge/less, league/climate
    - PHPUnit, phpmd

---
## Yireo Whoops
- `github.com/yireo/Yireo_Whoops`
- Interceptors
    - Using an interceptor to replace exception handler
- Composer
    - Using the generic PHP Whoops library

---
## Composer.json
```json
{
    ...
    "type": "magento2-module",
    ...
    "require": {
        "magento/framework": "100.*",
        "filp/whoops": "^2.1",
        "php": ">=5.6.0"
    }
    ...
}
```

---
class: center, middle
## M2 brings PHP to Magento

---
class: center, middle
## M2 brings Magento to PHP

---
class: center, middle, orange
## Community

---
## Upcoming events
- MeetMagento NL
    - 10 May 2017, Utrecht
    - www.meet-magento.nl
- MageUnconference NL
    - 25-27 August 2017, Utrecht
    - nl.mageuc.org
- MageTestFest
    - 17 November 2017, Utrecht
    - magetestfest.nl

---
class: center, middle
## For all of us
### magento.reageer.tv
