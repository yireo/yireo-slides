layout: true
<div class="slide-footer">
    <span>Messing Up DI - Jisse Reitsma - MeetMagento Belgium 2017</span>
</div>

---
class: center, middle, world, bgimage
# Messing Up
## Dependency Injection

MeetMagento Belgium 2017<br/>

---
class: orange
# About me
- Jisse Reitsma
--

- Founder of Yireo (Netherlands)
--

- Trainer, consultant, developer
--

- Magento 2 Master "Mover" (2017)

---
# My talk
- Dependency Injection
- What not to do in DI
- Refactoring

---
class: center, middle, orange
# Dependency Injection
## (in short: DI)

---
# DI in Magento 2
- Constructor based DI
--

- Inversion of Control
--

- Hollywood Principle
    - Don't call us, we call you

---
class: center, middle
# Remember `Mage`?
### `Mage::getSingleton()`
### `Mage::getModel()`

---
class: center, middle, orange
# ObjectManager is god

---
# Sample helper
```php
namespace Yireo\Example\Helper;
use Magento\Framework\Logger\Monolog as Logger;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    private $logger;

    public function __construct(Logger $logger, Context $context)
    {
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function vardump($text, $variable)
    {
        $text = $text . ' = ' . var_export($variable, true);
        $this->logger->notice($text);
    }
}
```

---
class: center, middle, orange
# Did you see him?

---
# Sample helper
```php
namespace Yireo\Example\Helper;
use Magento\Framework\Logger\Monolog as Logger;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    private $logger;

    public function __construct(Logger $logger, Context $context)
    {
        $this->logger = $logger;
        parent::__construct($context);
    }

    public function vardump($text, $variable)
    {
        $text = $text . ' = ' . var_export($variable, true);
        $this->logger->notice($text);
    }
}
```

---
class: zero
<div class="img-wrapper" style="background-image: url(../slides/yireo/images/riccardo-meme-resized.jpg)">
<h1>I beg your pardon?</h1>
</div>

---
# Lessons
- Don't use helpers
    - [Helpers are code smell](http://www.robbagby.com/posts/helper-classes-are-a-code-smell/) (thanks @WebShopApps)


---
# Sample logger
```php
namespace Yireo\Example\Logger;
use Magento\Framework\Logger\Monolog;

class Logger
{
    protected $logger;

    public function __construct(Monolog $logger)
    {
        $this->logger = $logger;
    }

    public function vardump($text, $variable)
    {
        $text = $text . ' = ' . var_export($variable, true);
        $this->logger->notice($text);
    }
}
```

---
# Depend on interfaces
```php
namespace Yireo\Example\Helper;
use Psr\Log\LoggerInterface as Logger;

class Logger
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function vardump($text, $variable)
    {
        $text = $text . ' = ' . var_export($variable, true);
        $this->logger->notice($text);
    }
}
```

---
# Lessons
- Don't use helpers
- Depend on interfaces
    - Dependency inversion principle of SOLID

---
class: center, middle, zero

---
# Product model
```php
namespace Magento\Catalog\Model;
use ...;

class Product extends AbstractModel
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

- One of these constructor arguments is `$context`, containing another 20+ dependencies

---
# Lessons
- Don't use helpers
- Depend on interfaces

--
- Try to keep dependencies to a minimum
    - Move all similar dependencies to a common class
    - Move around dependencies until each class has as little dependencies as possible

---
class: center, middle, zero

---
# Check your $context
```php
class Data extends AbstractHelper
{
}
```

```php
abstract class AbstractHelper
{
    public function __construct(Context $context)
    {
        $this->_logger = $context->getLogger();
    }
}
```

---
# Reusing $context
```php
namespace Yireo\Example\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    public function vardump($text, $variable)
    {
        $text = $text . ' = ' . var_export($variable, true);
        $this->_logger->notice($text);
    }
}
```

---
class: center, middle
# Migrating from 2.0 to 2.1 ?

---
class: center, middle, orange
# Do not ignore $context
Magento 2.0 *allowed* for this to happen

Magento 2.1 made this more strict: It gives an exception if you inject something that is already injected. In short: You
can't ignore `$context`.

---
class: center, middle
# Migrating from 2.1 to 2.2 ?

---
class: center, middle, orange
# Ignore $context
Magento 2.2 removes the restriction again. We can depend on parent classes to hand us `$context`, but we should be free to remove parent
dependencies as well (favoring composition over inheritance).

---
class: center, middle, zero
<div style="position:relative;">
<img src="../images/magetitans-it/depressed.jpg" class="img-responsive" />
</div>

---
class: center, middle, zero

---
# Lessons
- Don't use helpers
- Depend on interfaces
- Try to keep dependencies to a minimum

--
- Use `$context` (2.1) or ignore `$context` (2.2)

---
class: center, middle, orange
# Composition over inheritance

---
# Composition over inheritance
- Refactor a class by grouping together features
- Move common features to dedicated classes
- Inject those classes instead of using parents

---
# Product model
```php
namespace Magento\Catalog\Model;
use ...;

class Product extends AbstractModel
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
# Lessons
- Don't use helpers
- Depend on interfaces
- Try to keep dependencies to a minimum
- Use `$context` (2.1) or ignore `$context` (2.2)
- Depend on service interfaces instead of models
    - `ProductRepositoryInterface` instead of `Product` model

---
# StackExchange example
```php
use Magento\Framework\ObjectManager;
use Psr\Logger\LoggerInterface;

class Example
{
    private $objectManager;

    public function __construct(
        ObjectManager $objectManager
    ) {
        $this->objectManager = $objectManager;
    }

    public function vardump($text, $variable)
    {
        $logger = $this->objectManager->get(LoggerInterface:class);
        $text = $text . ' = ' . var_export($variable, true);
        $logger->notice($text);
    }
}
```

---
class: zero
<div class="img-wrapper" style="background-image: url(../slides/yireo/images/riccardo-meme-resized.jpg)">
<h1>I beg your pardon?</h1>
</div>

---
# Lessons
- Don't use helpers
- Depend on interfaces
- Try to keep dependencies to a minimum
- Use `$context` (2.1) or ignore `$context` (2.2)
- Depend on service interfaces instead of models

--
- Never inject Object Manager


---
class: center, middle
# Factories

---
# Using factories
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
# Object Manager should NEVER be used - except in factories, manual proxies, shell scripts, builders, weird interceptors, unit tests, integration tests

---
# Lessons
- Don't use helpers
- Depend on interfaces
- Try to keep dependencies to a minimum
- Use `$context` (2.1) or ignore `$context` (2.2)
- Depend on service interfaces instead of models
- Never inject Object Manager
    - Except for some edge cases

---
# Lessons
- Don't use helpers
- Depend on interfaces
- Try to keep dependencies to a minimum
- Use `$context` (2.1) or ignore `$context` (2.2)
- Depend on service interfaces instead of models
- Never inject Object Manager
- Do not inject exceptions, plugins, proxies

---
class: center, middle
# Keep refactoring

---
class: orange, center, middle
<h1 class="magetestfest"><span>Mage</span><span>Test</span><span>Fest</span></h1>

---
class: center, middle, world
# See you soon!
### @jissereitsma
