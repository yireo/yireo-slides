layout: true
<div class="slide-heading">Magento 2 for all of us</div>
<div class="slide-footer">
    <span>Magento 2 for all of us - Jisse Reitsma - slides.yireo.com</span>
</div>

---
class: center, middle
# Magento 2
### For all of us

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
- A customer says "Help, my shop is slow"
    - 4.000 SKUs
    - 4 Gb RAM
    - Magento specialized hosting

---
# Example Magento shop
- A customer says "Help, my shop is slow"
- My first glance (Oct 2016)
    - 4.000 Configurable Products
    - 4 million Simple Products
    - Server without SSD and still on PHP 5.3

---
# Example Magento shop
- A customer says "Help, my shop is slow"
- My first glance
- My second glance
    - Outdated environment
    - No budget
    - No developer involved

---
# Magento performance
- Fast server with sufficient RAM and SSD
--

- Nginx, PHP-FPM, PHP 7
--

- Redis, memcache (sessions and cache)
--

- RequireJS bundling, Grunt LESS compilation
--

- Optimized MySQL (Percona, InnoDB tuning)
--

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
--

- Product Types: Configurable, Bundled, Grouped
--

- XML Layout and PHTML templating
--

- Multistore, multisite, multilingual

---
# Magento tools
- PhpStorm + Magicento plugin
--

- magerun CLI tool
--

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
# Magento 2

---
# Why Magento 2?
- Released november 2015
--

- Complete rewrite of Magento 1
--

- Modern PHP architecture
    - DI, composer, PSR
--
- More extensible than Magento 1

---
class: center, middle
# Still slow?

---
# Magento 2 performance

--
- Code compilation

--
- Static file deployment

--
- Prototype versus jQuery+Require+Knockout

--
- Varnish integration

--
- Confusing benchmarks

---
class: center, middle
# Still complex?

---
# Magento 2 complexity
- Dependency Injection
- Composer
- RequireJS, KnockoutJS, UIComponents
- Code compilation
- Static file deployment

---
class: center, middle
## Still Magento

---
class: center, middle, orange

---
class: center, middle, orange
# Magento 2 DI

---
# Magento 2 DI
- Dependency Injection
- Object Manager (DI Container)
- Configurable via XML
    - Preferences, types, virtual types
    - Factories, builders, proxies
    - Plugins / interceptors

---
# Magento 2 Interceptors
- Middleware in Magento 2
    - Original class
    - Plugin class
    - Results in interceptor class
- Based on DI and code compilation

---
# Interceptors (1/3)
`etc/di.xml` (module):
```xml
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:noNamespaceSchemaLocation="urn:magento:framework:
ObjectManager/etc/config.xsd">
    <type name="Magento\Catalog\Model\Product">
        <plugin 
            name="uniqueFoobarName"
            type="Yireo\FooBar\Plugin\Catalog\ProductPlugin"
            sortOrder="1"
            disabled="false" />
    </type>
</config>
```

---
# Interceptors (2/3)
`Magento\Catalog\Model\Product.php` (core):
```php
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
`Plugin\Catalog\ProductPlugin.php` (module):

```php
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
# Dependency Injection
- Preference
    - Regular mapping between class and interface
- Type
    - Specific mapping between class and interface

---
# Dependency Injection (1 of 3)
`/app/etc/di.xml` (core):
```xml
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <preference
        for="Psr\Logger\LoggerInterface"
        type="Magento\Framework\Logger\Monolog" />
</config>
```

---
# Dependency Injection (2 of 3)
`etc/di.xml` (module):
```xml
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <type name="Yireo\FooBar\Plugin\Catalog\ProductPlugin">
        <arguments>
            <argument name="logger" xsi:type="object">
                Yireo\CustomLogger\Logger
            </argument>
        </arguments>
    </type>
</config>
```

---
# Dependency Injection (3 of 3)
`Plugin\Catalog\ProductPlugin.php` (module):

```php
namespace Yireo\FooBar\Plugin\Catalog;
use Magento\Catalog\Model\Product;

class ProductPlugin
{
    public function __construct(
        \Psr\Logger\LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function beforeSetName(Product $subject, $name)
    {
        $this->logger->notice($name);
        return array($name);
    }
}
```

---
class: center, middle, orange
## “Would it save you a lot of time if I just gave up and went mad now?” 
### Douglas Adams
### The Hitchhiker's Guide to the Galaxy

---
# Complex?
--

- Build anything you want
    - Within a full-blown application, not a framework!
--
- Customizable and reusable code
    - Shitload of Magento modules
--
- Requires a learning curve
    - Well, it's IT

---
# Magento 2 composer
- GitHub releases
- Satis, Toran Proxy, Private Packagist
- Integration of common packages
    - PSR, Monolog
    - oyejorge/less, league/climate
    - PHPUnit, phpmd

---
# Yireo Whoops
- `github.com/yireo/Yireo_Whoops`
- Interceptors
    - Using an interceptor to replace exception handler
- Composer
    - Using the generic PHP Whoops library

---
# Yireo Whoops
`composer.json`:
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
# Yireo Whoops
`etc/di.xml` (module):
```xml
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <preference
        for="Whoops\Handler\HandlerInterface"
        type="Whoops\Handler\PrettyPageHandler" />
    <type name="Magento\Framework\App\Http">
        <plugin
            name="Yireo_Whoops_Plugin_HttpApp"
            type="\Yireo\Whoops\Plugin\HttpApp" />
    </type>
</config>
```

---
class: center, middle
# M2 brings PHP to Magento

---
class: center, middle
# M2 brings Magento to PHP

---
class: center, middle, orange
# Community

---
# Community
- Global
    - MeetMagento conferences
    - Magento Stack Exchange
- Local
    - Dutchento (Netherlands)
    - Firegento (Germany)

---
# Upcoming events
- MageUnconference NL
    - 25-27 August 2017, Utrecht
    - nl.mageuc.org
- MageTestFest
    - 17 November 2017, Utrecht
    - magetestfest.nl

---
class: center, middle
### Magento 2
## For all of us

---
class: center, middle
# thanks
