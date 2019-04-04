# End-to-end testing
## with Codeception

---
# Codeception
- Testing framework
    - PHP, JavaScript
- Running on Selenium
    - Webdriver API (Chrome, Firefox)
- Used by MFTF
    - Magento Functional Testing Framework

---
# Webdriver API
- Part of W3C specs
    - https://www.w3.org/TR/webdriver1/
- Different engines for different browsers
    - ChromeDriver
    - geckodriver
    - Edge webdriver
    - OperaChromiumDriver
- Different adapters for different languages
    - PHP, python, Java, C#, Ruby, JavaScript, ...

---
# Selenium
- Browser Automation Framework
- Built on top of the Webdriver API
- Java Standalone Server
- Client drivers
    - Java, C#, Ruby, Python, Node
- Selenium IDE
    - Browser plugin in Chrome and Firefox

---
# Codeception
- Testing framework (BDD)
    - Selenium testing
    - API tests
    - PHPUnit tests
- ... or JavaScript
- Installable via `composer`

---
# Codeception CEST example
```php
$I->amOnPage('/');
$I->click('Enter');
$I->see('Welcome');
```

---
# Getting started
Bare minimum:
```bash
composer require codeception/codeception --dev
php vendor/bin/codecept
php vendor/bin/codecept bootstrap
```

Additional:
```bash
composer require facebook/webdriver
composer require me-io/selenium-appium-server
```

---
# Setting up tests (1/2)
- Acceptance tests
    - `tests/acceptance.suite.yml`
- Functional tests
    - `tests/functional.suite.yml`

---
# Setting up tests (2/2)
File `functional.suite.yml`
```
actor: FunctionalTester
modules:
    enabled:
        - WebDriver
    config:
      WebDriver:
        url: http://magento2.yr/
        browser: chrome
```

---
# Creating a test
Generate test file:
```bash
vendor/bin/codecept g:cest acceptance AddToCart
```

Modify `tests/acceptance/AddToCartCest.php`

Run tests:
```bash
codecept run acceptance AddToCartCest
```

---
# Codeception demo

---
# Best practices
- Create StepObjects
- Create PageObjects
- Or maybe even include a Magento database ...?

---
# Magento Functional Testing Framework
- Magento Functional Testing Framework
- Introduced in Magento 2.2
- Stable since Magento 2.3
- Compiling XML tests to CodeCeption tests
    - CodeCeption
    - Selenium
    - Allure

---
# Benefits of MFTF
- Extensible tests to prevent conflicts
- Covered by Magento core (2.3+)
- Added value for 3rd party extensions

---
# Command line
```shell
vendor/bin/mftf --version
composer show magento/magento2-functional-testing-framework
```

---
# Tests in modules
- `app/code/Yireo/Example/Test/Mftf`
- `vendor/yireo/example/Test/Mftf`

Structure within `Mftf` folder:
- `ActionGroup/`
- `Data/`
- `Metadata/`
- `Page/`
- `Section/`
- `Test/`

---
# Getting started (1/x)
- Install Java, Selenium, Chrome driver and Allure CLI
- Run Selenium Server (Java JAR)

---
# Getting started (2/x)
Modify Magento settings:
```shell
magerun2 config:set cms/wysiwyg/enabled disabled
magerun2 config:set admin/security/admin_account_sharing 1
magerun2 config:set admin/security/use_form_key 0
```

---
# Getting started (3/x)
Build the project:
```shell
vendor/bin/mftf build:project
vendor/bin/mftf generate:urn-catalog .idea/
```

---
# Getting started (4/x)
Edit `dev/tests/acceptance/.env`
- `MAGENTO_BASE_URL`
- `MAGENTO_BACKEND_NAME`
- `MAGENTO_ADMIN_USERNAME`
- `MAGENTO_ADMIN_PASSWORD`

---
# Getting started (5/x)
There we go:
```shell
cp dev/tests/acceptance/.htaccess.sample dev/tests/acceptance/.htaccess
vendor/bin/mftf generate:tests -f
cd dev/tests/acceptance && vendor/bin/codecept run functional
```

```shell
vendor/bin/mftf run:test AdminLoginTest --remove
```

---
# MFTF test case

---
# MFTF demo

---
# Other mentions
- BrowserStack
- Appium
