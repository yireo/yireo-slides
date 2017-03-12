layout: true
<div class="slide-heading">Messing Up DI</div>
<div class="slide-footer">
    <span>Messing Up DI - Jisse Reitsma - Meet Magento Croatia 2017</span>
</div>

---
class: center, middle, world, bgimage
# Messing Up
## Dependency Injection

Meet Magento Croatia 2017
Osijek, Croatia

---
class: orange
# About me
- Jisse Reitsma
--

- Founder and lead developer of Yireo
--

- Trainer, enterpreneur, coder
--

- Magento 2 Master "Mover" (2017)
--

- Knockout JiSse (I don't why)
--

- Loving Magento 2

---
# My talk
- Dependency Injection
- ObjectManager & Factory
- Refactoring

---
class: center, middle, orange
# Dependency Injection
## (DI)


---
# DI in Magento 2
- Constructor based DI
--

- Inversion of Control
--

- Hollywood Principle
    - Don't call us, we call you
--
- ObjectManager is our new god
--

- Code smells are still around

---
# DI in theory
```php
namespace Yireo\Example\Helper;
use Magento\Framework\Logger\Monolog;

class Data
{
    protected $logger;

    /**
     * Don't mention interfaces yet
     */
    public function __construct(Monolog $logger)
    {
        $this->logger = $logger;
    }

    public function warning($text)
    {
        $this->logger->warning($text);
    }
}
```

---
# DI in practice 
```php
namespace Yireo\Example\Helper;
use Magento\Framework\Logger\Monolog;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    protected $logger;

    /**
     * Still don't mention interfaces yet
     */
    public function __construct(Monolog $logger, Context $context)
    {
        $this->logger = $logger;
        parent::__construct($context);
    }

    ...
}
```

---
# Product model
```php
namespace Magento\Catalog\Model;
use ...;

class Product extends \Magento\Catalog\Model\AbstractModel 
  implements IdentityInterface, SaleableInterface, ProductInterface
{
    public function __construct(
        Context $context,
        Registry $registry,
        ExtensionAttributesFactory $extensionFactory,
        AttributeValueFactory $customAttributeFactory,
        StoreManagerInterface $storeManager,
        ProductAttributeRepositoryInterface $metadataService,
        Product\Url $url,
        Product\Link $productLink,
        OptionFactory $itemOptionFactory,
        ...
    ) {
        ...
```

---
# Too many dependencies
- `Product` model has 35 constructor arguments
--

- One of these constructor arguments is `$context`

---
# Discovering $context
```php
namespace Magento\Framework\App\Helper;

abstract class Helper
{
    public function __construct(Context $context)
    {
        $this->_moduleManager = $context->getModuleManager();
        $this->_logger = $context->getLogger();
        $this->_request = $context->getRequest();
        $this->_urlBuilder = $context->getUrlBuilder();
        $this->_httpHeader = $context->getHttpHeader();
        $this->_eventManager = $context->getEventManager();
        $this->_remoteAddress = $context->getRemoteAddress();
        $this->_cacheConfig = $context->getCacheConfig();
        $this->urlEncoder = $context->getUrlEncoder();
        $this->urlDecoder = $context->getUrlDecoder();
        $this->scopeConfig = $context->getScopeConfig();
    }
}
```

---
class: center, middle, orange
# Why bother with underscores?
Both `$this->_logger` and `$this->urlEncoder` are protected

---
# Too many dependencies
- `Product` model has 35 constructor arguments
- One of these constructor arguments is `$context`
    - `Context` contains another 20+ dependencies

---
# Lessons
- Don't inject logger, but check your `$context` first

---
class: center, middle, orange
# Ignoring $context
Magento 2.0 *allowed* for this to happen

Magento 2.1 made this more strict: It gives an exception if you inject something that is already injected. In short: You
can't ignore `$context`.

---
# Lessons
- Don't inject logger, but check your `$context` first
--

- Keep the number of dependencies to a minimum
    - Move all similar dependencies to a common class
    - Move around dependencies until each class has as little dependencies as possible

---
class: center, middle, orange
# Composition over inheritance

---
# Composition over inheritance
- Refactor a class by grouping together features
- Move common features to dedicated classes
- Inject those classes instead of using parents

---
class: center, middle, keepasecret, bgimage
# Entity Manager

---
class: center, middle
# ObjectManager & Factory

---
# Using DI
- Requires object to be injectable
--

- Non-injectables can't be injected via DI
--

- Non-injectables can be instantiated by ObjectManager
--

- Solution: Use a Factory

---
# Factory
```php
namespace Magento\Core\Model\Config;

use Magento\Framework\ObjectManager;

class BaseFactory
{
    protected $_objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->_objectManager = $objectManager;
    }

    public function create($sourceData = null)
    {
        return $this->_objectManager->create(
            'Magento\Core\Model\Config\Base', 
            array('sourceData' => $sourceData));
    }
}
```

---
class: center, middle, orange
# Object Manager should NEVER be used

---
class: center, middle, orange
# Object Manager should NEVER be used - except in factories

---
class: center, middle, orange
# Object Manager should NEVER be used - except in factories, shell scripts, builders, weird interceptors, unit tests

---
class: center, middle
# Interfaces

---
# DI in theory
```php
namespace Yireo\Example\Helper;
use Magento\Framework\Logger\Monolog;

class Data
{
    protected $logger;

    public function __construct(Monolog $logger)
    {
        $this->logger = $logger;
    }

    public function warning($text)
    {
        $this->logger->warning($text);
    }
}
```

---
# DI in better theory
```php
namespace Yireo\Example\Helper;
use Psr\Log\LoggerInterface;

class Data
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function warning($text)
    {
        $this->logger->warning($text);
    }
}
```

---
# Better theory
- Only use interfaces for constructor arguments 
    - Use PhpStorm + Magicento2 to open up right `di.xml`
--
- Define interfaces for most of your own classes
    - Map interfaces to real classes using Preferences

---
# Focusing on Product again 
- `Product` model has 35 constructor arguments
--

- 5 out of 35 are actually interfaces
--

- However, about 10 are Factories that generate interfaces

---
class: center, middle
### My question to Anton Krill (DevParadise 16):
> Isn't there a Dependency Hell
> within Magento 2?

---
class: center, middle
### Anton Krills answer:
> ...

---
class: center, middle
### Anton Krills answer:
> Yes.

---
class: center, middle
### Anton Krills answer:
> Yes. Just like in Magento 1.

---
class: center, middle
### Anton Krills answer:
> Yes. Just like in Magento 1.
> But now we can actually fix it.

---
class: center, middle
# Conclusion

---
class: center, middle
# Keep refactoring

---
class: center, middle, world
# @yireo
# @jissereitsma

