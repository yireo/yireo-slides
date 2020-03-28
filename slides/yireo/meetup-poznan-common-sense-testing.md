{state: main middle}
{background-image: meetup-poznan/saddhu.jpg}
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
~ Or actually a good mix of all of the above

???
Show of hands: How many of you have worked with which type of tests?

Unit testing: Testing of a single point of functionality (a method, a class, a module), with all of its outside-world dependencies being replaced with stubs and/or mocks.

Integration testing: Testing your own code in combination with other code (that is already unit tested) to test the functionality of a greater whole.

Functional testing: A combination of modules or the entire application is tested for the functionality described in a certain scenario. Instead of testing the individual code parts using integration tests, the overall functionality is tested for.

Acceptance testing: Same as functional testing, but by thinking about the functionality as the end-customer and not as the developer.

End-to-end testing: Same as with acceptance testing, but often done by non-developers.

Smoke testing: Simple integration tests that simply check if the system under test (Magento) is behaving correctly. This can be accomplished by other tests from above, because it is more a procedure than a specific way to write tests.

Regression testing: Tests to confirm that a change in code is not having unexpected effects elsewhere. This can be accomplished by other tests from above, because it is more a procedure than a specific way to write tests.

Performance testing: Tests that measure whether performance metrics are still acceptable. Examples are loading times, the number of SQL queries, responses from microservices, memory usage. Tests could be written as functional tests or integration tests, or external tools like Blackfire could be used.

Property-based testing: Ask Vinai Kopp.

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
- Mocking & Stubbing
- Code coverage
    - And 100% code coverage is the end goal
- Test Driven Development
    - Red-Green-Refactor

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
# Tip: Better example
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
# Tip: Even better example
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
# Real-life integration test (1)
```php
namespace Yireo\Example\Test\Integration\Helper;
use Yireo\Example\Helper\Data;
use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Helper\Bootstrap;
class DataTest extends TestCase {
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 1
     */
    public function testIsEnabled() {
        $objectManager = Bootstrap::getObjectManager();
        $helper = $objectManager->create(Data::class);
        $this->assertTrue($helper->isEnabled());
    }
}
```

---
# Real-life integration test (2)
```php
namespace Yireo\Example\Test\Unit\Helper;
use Yireo\Example\Helper\Data;
use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Helper\Bootstrap;

class DataTest extends TestCase {
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 0
     */
    public function testIsDisabled() {
        $objectManager = Bootstrap::getObjectManager();
        $helper = $objectManager->create(Data::class);
        $this->assertFalse($helper->isEnabled());
    }
}
```

---
# Real-life integration test (3)
```php
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 0
     */
    public function testIsEnabled() {
        $objectManager = Bootstrap::getObjectManager();
        $helper = $objectManager->create(Data::class);
        $this->assertFalse($helper->isEnabled());
    }
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 0
     */
    public function testIsDisabled() {
        $objectManager = Bootstrap::getObjectManager();
        $helper = $objectManager->create(Data::class);
        $this->assertFalse($helper->isEnabled());
    }
}
```

---
# Real-life integration test (4)
```php
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 0
     */
    public function testIsEnabled() {
        $this->assertFalse($this->getHelper()->isEnabled());
    }
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 0
     */
    public function testIsDisabled() {
        $this->assertFalse($this->getHelper()->isEnabled());
    }
    private function getHelper() {
        $objectManager = Bootstrap::getObjectManager();
        return $objectManager->create(Data::class);
    }
}
```

---
# Personal opinion: I don't believe in 100% code coverage

---
# Running Magento Integration Tests
@todo

---
# Tip: Making Magento Integration Tests run fast
- @todo: MySQL tmpfs database
- @todo: Replace unneeded Magento modules (like bundled extensions nobody uses)
- @todo: ReachDigital Quick Integration Framework

https://www.yireo.com/blog/2019-05-04-faster-magento2-integration-tests

---
# My own `ExampleDealers` module-set
@todo: Dealers example, split up in modules

---
# What about functional tests?

---
# Functional tests
- Integration Tests with real-life Magento instance
- Functional tests based on MFTF

@todo: MFTF for agencies? ExtDN

---

---
# Guaranteeing code quality
~ Run PHP CodeSniffer rules regularly
    - Magento Coding Standard
    - PSR-1, PSR-2, PSR-12
    - Object Calisthenics
~ Run static analysis tools
    - PHPStan
~ Use PHP 7 type hinting
    - `declare_strict_types=1`
    - Return typing, argument hinting
- Coding standards
    - Object Calisthenics
    - SOLID, DRY

---
# What not to test?
@todo: Stupid test: $assertInstanceOf(...) - add PHP7 type hinting

---
# End-to-end testing
- Selenium, Codeception
- Cypress.io



---
# Where to start?

---
# Unit testing? Integration testing? End-to-end testing?

---
# My advice: Start where it hurts

---
# Where does it hurt?
~ Going live with untested code
~ Seeing the same bug occur multiple times in your life
~ Pushing new code while not being totally confident of it

---
# If you don't understand it, create a test for it

---
# Learn by testing
~ Create simple tests
    - Integration tests to find out about Magento internals
    - Tape to learn language concepts of NodeJS

---
# Fix your next bug via a test

---
# Fix your next bug via a test
- Proof the bug using a test
    - Unit, integration, functional, end-to-end, whatever
- Run the test so it fails
- Fix the bug
- Run the test so it success
- Keep running the test(s) every time again and again
    - So it will never fail again

---
{state: main dark center middle}
{background-image: mm19pl/heman.jpg}
# Your common sense is most important
## when writing tests
#### slides.yireo.com/yireo/meetup-poznan-common-sense-testing
