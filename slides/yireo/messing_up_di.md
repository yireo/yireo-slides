layout: true
<div class="slide-footer">
    <span>Messing Up DI - Jisse Reitsma - MageTitans Italy 2017</span>
</div>

---
class: center, middle, world, bgimage
# Messing Up
## Dependency Injection

MageTitans Italy 2017<br/>
Milano, Italia

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
--

- Knockout JiSse (I don't why)

---
# My talk
- Dependency Injection
- ObjectManager & Factory
- Refactoring

---
class: center, middle, zero
<div style="position:relative;">
<img src="../images/magetitans-it/spaghetti.jpg" class="img-responsive" />
<div style="position:absolute; top:-30px; left:0; right:0; text-align:center;">
    <h1 class="shadow" style="font-size: 400%">I <i class="fa fa-heart"></i> Spaghetti</h1>
</div>
</div>

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
class: center, middle, orange
# ObjectManager is god

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
# Lessons
- Don't use helpers
    - [Helpers are code smell](http://www.robbagby.com/posts/helper-classes-are-a-code-smell/) (thanks @WebShopApps)


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

    public function __construct(Monolog $logger, Context $context)
    {
        $this->logger = $logger;
        parent::__construct($context);
    }

    ...
}
```

---
# DI with interfaces
```php
namespace Yireo\Example\Helper;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class Data extends AbstractHelper
{
    protected $logger;

    public function __construct(Logger $logger, Context $context)
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
class: center, middle, zero
<div style="position:relative;">
<img src="../images/magetitans-it/spaghetti-baby.jpg" class="img-responsive" />
<div style="position:absolute; bottom:60px; left:0; right:0; text-align:center;">
    <h1 class="shadow" style="font-size: 300%">Spaghetti Code</h1>
</div>
</div>


---
# Too many dependencies
- `Product` model has 35 constructor arguments
--

- One of these constructor arguments is `$context`, containing another 20+ dependencies

---
# Lessons
- Don't use helpers

--
- Try to keep dependencies to a minimum
    - Move all similar dependencies to a common class
    - Move around dependencies until each class has as little dependencies as possible

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
    public function warning($text)
    {
        $this->_logger->warning($text);
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
<img src="../images/magetitans-it/swedish-chef.jpg" class="img-responsive" />
</div>

---
# Lessons
- Don't use helpers
- Try to keep dependencies to a minimum

--
- Check your `$context` first (2.1)
    - Or choose to ignore it on purpose (2.2)
--
- Depend on interfaces instead of classes
    - Check if there is a `preference`

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
- Try to keep dependencies to a minimum
- Check your `$context` first
- Depend on service interfaces instead of models
    - `ProductRepositoryInterface` instead of `Product` model

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
# Object Manager should NEVER be used - except in factories, shell scripts, builders, weird interceptors, unit tests

---
# Lessons
- Don't use helpers
- Try to keep dependencies to a minimum
- Check your `$context` first
- Depend on interfaces instead of classes
- Depend on service interfaces instead of normal

--
- Never inject Object Manager
    - Except for edge cases (factories, scripts, testing, ...)


the-godfather-1.jpg

---
class: center, middle, orange
# Not everything in the Magento core might be the best of examples

---
class: center, middle
# Keep refactoring

---
class: orange, center, middle
<h1 class="magetestfest"><span>Mage</span><span>Test</span><span>Fest</span></h1>

---
class: center, middle, world
# Heads up?
### @jissereitsma

