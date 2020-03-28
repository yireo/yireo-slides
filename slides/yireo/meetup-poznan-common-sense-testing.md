{state: main middle}
{background-image: meetup-poznan/cinderella.jpg}
# Common sense in testing
## Don't trust what the gurus tell you
#### by Jisse Reitsma (Yireo)

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of developers
    - Magento frontend & backend development
    - React (PWA Studio)
    - Vue (Vue Storefront)

---
{state: dark center middle}
# Working on remote training sessions
### Because of the Corona crisis

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
- Founder of Yireo
- Trainer of developers
- Creator of MageTestFest (2017, 2018)
~ Creator of Reacticon (2018 x2)
~ Creator of Reacticon v3 (June 2020)

---
{state: dark center middle}
# Reacticon v3 is postponed to October 2020
### Because of the Corona crisis

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
- Founder of Yireo
- Trainer of developers
- Creator of MageTestFest (2017, 2018)
- Creator of Reacticon (2018 x2)
- Creator of Reacticon v3 (June 2020)
- Magento Master 2017/2018/2019 Mover
~ Member of ExtDN (Magento Extension Developer Network)
~ Doing some stuff where testing makes sense

---
{state: dark center middle}
# Do stuff where testing makes sense

---
{state: dark}
# Testing stuff
~ Unit testing
~ Integration testing
~ Functional testing
~ Acceptance test
~ End-to-end testing
~ Smoke testing (sanity checks)
~ Regression testing
~ Performance testing
~ Property-based testing

???
Unit testing: Testing of a single point of functionality (a method, a class, a module), with all of its outside-world dependencies being replaced with stubs and/or mocks.

@todo: Add definition for all

Smoke testing: Simple integration tests that simply check if the system under test (Magento) is behaving correctly.

---
{state: dark center middle}
# Where to begin?

---
# Unit test
```php
use PHPUnit\Framework\TestCase;
class DataTest extends TestCase {
    public function testWhetherTestWorks() {
        $this->assertTrue(false);
    }
}
```

---
# Concepts
- Mocking
- Stubbing


---
# Some helper class
```php
namespace Yireo\Example\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper {
    public function isEnabled() {
        return (bool) $this->scopeConfig->getValue(
            'foobar/settings/enabled',
            ScopeInterface::SCOPE_STORE
        );
    }
}
```

---
# Real-life unit test? (1)
```php
namespace Yireo\Example\Test\Unit\Helper;
use Yireo\Example\Helper\Data;
use PHPUnit\Framework\TestCase;
use Magento\Framework\App\Config\ScopeConfigInterface;

class DataTest extends TestCase {
    public function testIsEnabled() {
        ...
        $helper = new Data($context);
        $this->assertTrue($helper->isEnabled());
        $this->assertSame($helper->isEnabled(), true);
    }
}
```

---
# Real-life unit test? (2)
```php
...
class DataTest extends TestCase {
    public function testIsEnabled() {
        $scopeConfig = $this->getMockBuilder(ScopeConfigInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $scopeConfig->expects($this->any())
            ->method('getValue')
            ->with('foobar/settings/enabled')
            ->returnValue(1);
        ...
```

---
# Real-life unit test? (3)
```php
...
class DataTest extends TestCase {
    public function testIsEnabled() {
        ...
        $context = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();

        $context->expects($this->any())
            ->method('getScopeConfig')
            ->will($this->returnValue($scopeConfig)
        );
        ...
```

---
# Unit test in overview
In overview:

- We mock `Context`
- We mock `ScopeConfig` and add it to `Context`
- We instantiate `Helper` with `Context` mock

---
# What is wrong with this example?
~ Do not use helper classes
    - Refactor this to `Config` class
~ Only talk to your immediate friends
    - Only talk to your immediate friends (Law of Demeter, part of SOLID)
    - Get rid of parent classes; Refactor so that your dependencies are simple

---
# Better example
```php
namespace Yireo\Example\Config;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
class Config {
    public function __construct(ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled() {
        return (bool) $this->scopeConfig->getValue(
            'foobar/settings/enabled',
            ScopeInterface::SCOPE_STORE
        );
    }
}
```

---
# Better example
```php
declare(strict_types=1);
namespace Yireo\Example\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
class Config {
    public function __construct(ScopeConfigInterface $scopeConfig) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled(): bool {
        return (bool) $this->scopeConfig->getValue(
            'foobar/settings/enabled'
        );
    }
}
```

---
# What is wrong with this example?
- Do not use helper classes
    - Refactor this to `Config` class
- Only talk to your immediate friends
    - Only talk to your immediate friends (Law of Demeter, part of SOLID)
    - Get rid of parent classes; Refactor so that your dependencies are simple
~ Too much test code for something that mostly works fine anyway
    - Perhaps an integration test is easier

---
# Real-life integration test (1/2)
```php
namespace Yireo\Example\Test\Unit\Helper;
use Yireo\Example\Helper\Data;
use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Helper\Bootstrap;

class DataTest extends TestCase {
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 1
     */
    public function testIsEnabled() {
        ...
        $objectManager = Bootstrap::getObjectManager();
        $helper = $objectManager->create(Data::class);
        $this->assertTrue($helper->isEnabled());
    }
}
```

---
# Real-life integration test (2/2)
```php
namespace Yireo\Example\Test\Unit\Helper;
use Yireo\Example\Helper\Data;
use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Helper\Bootstrap;

class DataTest extends TestCase {
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 0
     */
    public function testIsEnabled() {
        ...
        $objectManager = Bootstrap::getObjectManager();
        $helper = $objectManager->create(Data::class);
        $this->assertFalse($helper->isEnabled());
    }
}
```


---
# Running Magento Integration Tests
@todo

---
# Making Magento Integration Tests performant
- @todo: MySQL tmpfs database
- @todo: Replace unneeded Magento modules (like bundled extensions nobody uses)
- @todo: ReachDigital Quick Integration Framework

---
@todo: Show example of Magento 2 unit test being too complex
@todo: Show same example with integration test
@todo: MFTF for agencies? ExtDN
@todo: Stupid test: $assertInstanceOf(...) - add PHP7 type hinting
@todo: Run PHPCS (Object Calisthenthics, Magento Coding Standard, PSR-12?, PHPStan)
@todo: Where to start? Unit testing or end-to-end. Where it hurts.
@todo: Fix bugs with a test
@todo: Refactor constantly
@todo: Dealers example, split up in modules


---
{state: main dark center middle}
{background-image: mm19pl/heman.jpg}
# We are ready for PWA
## slides.yireo.com/yireo/pwa_extensions-mm19pl
