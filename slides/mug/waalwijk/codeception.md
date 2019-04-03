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
- Testing framework
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
# Setting up tests
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
# Codeception demo

---
# Magento Functional Testing Framework

---
# MFTF test case

---
# MFTF demo

---
# Other mentions
- BrowserStack
- Appium
