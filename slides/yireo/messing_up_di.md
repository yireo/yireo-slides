layout: true
<div class="slide-heading">Messing Up DI</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com</span>
</div>

---
class: center, middle
# Messing Up
### Dependency Injection

---
# About me
- Jisse Reitsma
--

- Founder and lead developer of Yireo
--

- Trainer, enterpreneur, coder
--

- Wrote 2 developer books for J\*\*ml\*
--

- Loving Magento 2
--

---
# My talk
- Dependency Injection
- ObjectManager & Factory
- Interfaces

---
class: center, middle
# Dependency Injection (DI)


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

- Code smells are everywhere

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
        parent::construct($context);
    }

    ...
}
```

---
# Too many dependencies
```php
namespace Magento\Catalog\Model;
use ...;

class Product extends \Magento\Catalog\Model\AbstractModel 
    implements IdentityInterface, SaleableInterface, ProductInterface
{
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory,
        AttributeValueFactory $customAttributeFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Api\ProductAttributeRepositoryInterface $metadataService,
        Product\Url $url,
        Product\Link $productLink,
        \Magento\Catalog\Model\Product\Configuration\Item\OptionFactory $itemOptionFactory,
        ...
    ) {
        ...
```

---
# Too many dependencies
- `Magento\Catalog\Model\Product` has 35 constructor arguments
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
# Too many dependencies
- `Magento\Catalog\Model\Product` has 35 constructor arguments
- One of these constructor arguments is `$context`
    - `Magento\Framework\Model\Context` contains another 20+ dependencies
--
- What is the meaning of an underscore?
    - Both `$this->_logger` and `$this->urlEncoder` are protected

---
# Lessons
- Don't inject logger, but check your `$context` first
--

- Keep the number of dependencies to a minimum
    - Move all similar dependencies to a common class
    - Move around dependencies until each class has as little dependencies as possible
--
- Don't name your protected variables or methods with an underscore

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
# Lessons
- Object Manager should NEVER be used
--

- Except for in a Factory
--

- And CLI scripts
--

- And perhaps unit tests


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
- `Magento\Catalog\Model\Product` has 35 constructor arguments
--

- 5 out of 35 are actually interfaces
--

- However, about 10 are Factories that generate interfaces

---
class: center, middle
# Conclusion

---
# Conclusion
- Magento 2 is great
--

- Magento 2 is made by humans

---
class: center, middle
# End

