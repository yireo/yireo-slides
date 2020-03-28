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
~ I'm not a testing guru
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

class DataTest extends TestCase
{
    public function testWhetherTestWorks()
    {
        $this->assertTrue(false);
    }
}
```

Next, run `phpunit ./Test/Unit/DataTest.php` and see what is wrong.

---
# Concepts
- Mocking & Stubbing
- Code coverage
    - Is 100% code coverage the end goal?
- Test Driven Development
    - Red-Green-Refactor

---
{state: center middle}
# Personal opinion: I don't believe in 100% code coverage

---
# Some helper class (1)
```php
namespace Yireo\Example\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
}
```

---
# Some helper class (2)
```php
class Data extends AbstractHelper
{
    public function isEnabled()
    {
        return (bool) $this->scopeConfig->getValue(
            'foobar/settings/enabled',
            ScopeInterface::SCOPE_STORE
        );
    }
}
```

---
# ... and its parent
```php
abstract class AbstractHelper
{
    public function __construct(Context $context)
    {
        $this->scopeConfig = $context->getScopeConfig();
    }
}
```

---
{state: center middle}
# So let's  create a test for this

---
# Some unit test? (1)
```php
namespace Yireo\Example\Test\Unit\Helper;

use Yireo\Example\Helper\Data;
use PHPUnit\Framework\TestCase;
use Magento\Framework\App\Config\ScopeConfigInterface;

class DataTest extends TestCase
{
    public function testIsEnabled()
    {
        // @todo: Test whether the enabled flag is true
    }
}
```

---
# Some unit test? (2)
```php
/* @todo: Create a mock called $context */

$helper = new Data($context);
$this->assertTrue($helper->isEnabled());
```

---
# Some unit test? (3)
```php
/* @todo: Create a mock called $scopeConfig */

$context = $this->getMockBuilder(Context::class)
    ->disableOriginalConstructor()
    ->getMock();

$context->expects($this->any())
    ->method('getScopeConfig')
    ->will($this->returnValue($scopeConfig)
);

/* The rest of the code we already had */
```

---
# Some unit test? (4)
```php
$scopeConfig = $this->getMockBuilder(ScopeConfigInterface::class)
    ->disableOriginalConstructor()
    ->getMock();

$scopeConfig->expects($this->any())
    ->method('getValue')
    ->with('foobar/settings/enabled')
    ->returnValue(1);

/* The rest of the code we already had */
```

---
# Unit test in overview
In overview:

- We mock `Context`
- We mock `ScopeConfig` and add it to `Context`
- We instantiate `Helper` with `Context` mock as a constructor argument

---
# So we test the following code:
```php
return (bool) $this->scopeConfig->getValue(
    'foobar/settings/enabled',
    ScopeInterface::SCOPE_STORE
);
```

---
# With this:
```php
$scopeConfig = $this->getMockBuilder(ScopeConfigInterface::class)
    ->disableOriginalConstructor()->getMock();
$scopeConfig->expects($this->any())->method('getValue')
    ->with('foobar/settings/enabled')->returnValue(1);
$context = $this->getMockBuilder(Context::class)
    ->disableOriginalConstructor()->getMock();
$context->expects($this->any())->method('getScopeConfig')
    ->will($this->returnValue($scopeConfig));
$helper = new Data($context);
$this->assertTrue($helper->isEnabled());
```

---
{state: center middle}
# What is wrong with this example?

---
# What is wrong with this example?
~ Do not use helper classes
    - The word "Helper" doesn't properly describe the function of a class
    - Suggestion: Refactor this to `Config` class
~ Only talk to your immediate friends
    - Aka: Law of Demeter, part of SOLID
    - My helper talks to `Context` which talks to `ScopeConfig`.
    - Get rid of parent classes and refactor so that your dependencies are simple

---
# Tip: Better example
```php
namespace Yireo\Example\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function isEnabled() { /* same as before */ }
}
```

---
# Tip: Add type hinting
```php
declare(strict_types=1);
namespace Yireo\Example\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public function __construct() { /* same as before */ }

    public function isEnabled(): bool {/* same as before */ }
}
```

---
{state: center middle}
# What is still wrong with this example?

---
# What is still wrong with this example?
- Do not use helper classes
- Only talk to your immediate friends
~ Too much test code for something that mostly works fine anyway
    - If the unit test becomes too complex, because the unit is too complex?
    - Perhaps an integration test is easier?

---
# Real-life integration test (1)
```php
namespace Yireo\Example\Test\Integration\Helper;

use Yireo\Example\Helper\Data;
use PHPUnit\Framework\TestCase;
use Magento\TestFramework\Helper\Bootstrap;

class DataTest extends TestCase
{
}
```

---
# Real-life integration test (2)
```php
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 1
     */
    public function testIsEnabled()
    {
        $objectManager = Bootstrap::getObjectManager();
        $helper = $objectManager->create(Data::class);
        $this->assertTrue($helper->isEnabled());
    }
```

---
# Real-life integration test (3)
```php
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 0
     */
    public function testIsDisabled()
    {
        $objectManager = Bootstrap::getObjectManager();
        $helper = $objectManager->create(Data::class);
        $this->assertFalse($helper->isEnabled());
    }
}
```

---
{state: center middle}
# Slight refactoring

---
# Real-life integration test (4)
```php
    /**
     * @magentoConfigFixture current_store foo/settings/enabled 0
     */
    public function testIsEnabled()
    {
        $this->assertFalse($this->getHelper()->isEnabled());
    }

    private function getHelper(): Data
    {
        $objectManager = Bootstrap::getObjectManager();
        return $objectManager->create(Data::class);
    }
}
```

---
{state: center middle}
# Type hinting also gives confidence
## Just like testing

---
{state: center middle}
# Let's run integration tests

---
# Running Magento Integration Tests
- Install Magento 2
- Setup an empty test database
- Configure `dev/tests/integration/etc/install-config-mysql.php`
- Configure your test-suite in `dev/tests/integration/phpunit.xml`
- Run `cd dev/tests/integration && ../../../vendor/bin/phpunit -c ./phpunit.xml --testsuite Custom`
    - Or `bin/magento dev:tests:run integration`

---
# Tip: Making Integration Tests run fast
- Keep toggling `TESTS_CLEANUP`
- Run MySQL in tmpfs (easier with a separate Docker instance)
- Replace unneeded Magento modules (like bundled extensions nobody uses)
- Use the ReachDigital Quick Integration Framework

See: https://www.yireo.com/blog/2019-05-04-faster-magento2-integration-tests

---
# My own `ExampleDealers` module-set
- Separate modules
    - `ExampleDealers`: Core database functionality
    - `ExampleDealersCli`: Command-line access
    - `ExampleDealersAdminhtml`: Adminhtml access
    - `ExampleDealersFrontend`: Frontend access
    - `ExampleDealersGraphQl`: GraphQL access
- Tests per module

See: https://github.com/yireo-training and search for *Dealers*

---
{state: center middle}
# What about functional tests?

---
# Functional tests
~ Integration Tests with real-life Magento instance
    - Development, staging or production (yikes)
~ Functional tests based on MFTF)
    - Important for extension developers (like with ExtDN)
    - Not yet important for agencies

---
{state: center middle}
# There are more ways to check for code quality

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
~ Coding standards
    - Object Calisthenics
    - SOLID, DRY

---
# What not to test?
- Using `assertInstanceOf()` often is silly
    - Add PHP7 type hinting instead
- Private methods
    - Because they are private
- Exception messages

---
# End-to-end testing
- Selenium, Codeception
- Cypress.io

---
{state: center middle}
# Ok, I get it.
### Unit tests, integration tests, functional tests, end-to-end tests - they are all helpful and I should use them all.

---
{state: center middle}
# Where to start?
### Unit testing? Integration testing? End-to-end testing?

---
{state: center middle}
### My advice:
# Start where it hurts

---
# Where does it hurt?
~ Going live with untested code
~ Seeing the same bug occur multiple times in your life
~ Pushing new code while not being totally confident of it

---
{state: center middle}
### My advice:
# If you don't understand the code,
# create a test for it

---
# Learn by testing
~ Create simple tests about the system
    - Integration tests to find out about Magento internals
    - Tape to learn language concepts of NodeJS
~ Create advanced tests about the functionality
    - Functional tests to guarantee output
    - Or call them regression tests
    - Or whatever

---
{state: center middle}
### My advice:
# Fix your next bug via a test

---
# Fix your next bug via a test
~ Proof the bug using a test
    - Unit, integration, functional, end-to-end, whatever
~ Run the test so it fails
~ Fix the bug
~ Run the test so it success
~ Keep running the test(s) every time again and again
    - So it will never fail again

---
{state: center middle}
### My advice:
# If you start fresh, try TDD

---
# When you start fresh
- Stand-alone PHP microservice
- Stand-alone PHP classes in Magento 2
- Separate React or Vue component

---
{state: center middle}
### When writing tests
# your common sense is most important

---
{state: center middle}
# Thanks
#### slides.yireo.com/yireo/meetup-poznan-common-sense-testing
