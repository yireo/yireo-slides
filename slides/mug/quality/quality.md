class: center, middle
# Quality Assurance
### MUG &prime;s Hertogenbosch

---
# Quality Assurance
- Best practices
- Logs and tooling
- Coding
- Performance

---
# Do not call home
- Avoid extensions that call home
    - Extensions that load remote HTML in your frontend
    - Extensions that load remote executable PHP code
- More or less ok
    - Extensions that periodically show admin notices
    - Extensions that load remote HTML in your admin

---
# Do not encrypt
- Avoid ionCube extensions
    - No way to know what kind of rubbish is inside
    - Degrades performance

---
# Do not hack the core
- Use code-pools
    - Use `community` for sharable extensions
    - Use `local` for your own project
- Use parent/child theming
    - `THEME/default` is package
    - `THEME/custom` is your theme

---
# Find a good developer
- Knowledgable
    - Knows his/her stuff
    - GitHub contributions
- Certified
    - Magento Certified Developer
    - Magento Solution Partner
    - Zend Certified

---
# How to keep track?
- Use Git
    - Each change is a commit
- Use different environments
    - Development environment
    - Testing environment
    - Production environment
- Documentation / ticketing

---
# Goal: Zero logs in logfiles
- Apache error-log
- `var/log/system.log`
- `var/log/exception.log`
- `var/reports/*`

---
# Common errors in logs
- PHP Notices on uninitialized variables
- PHP Notices on constants that should be strings
- PHP Warnings on wrong loops
- Horrible Magento coding
- Exceptions on payment gateways

---
# Magento extensions
- AOEpeople Magento Project Mess detector
- Magento ECG Magniffer

---
# magerun commands
```
magerun composer:diagnose
magerun db:maintain:check-tables
magerun dev:module:rewrite:conflicts
magerun dev:module:rewrite:list
magerun dev:report:count
magerun dev:theme:duplicates
magerun diff:files
magerun mpmd:codepooloverrides
magerun mpmd:corehacks
magerun mpmd:dependencycheck
magerun sys:check
```

---
# PHP tools
- `phpcs` = PHP Code Sniffer
- `phpmd` = PHP Mess Detector
- PHP Copy/Paste Detector
- PHP Dead Code Detector
- PHP lint

---
# Coding standards
- https://github.com/magento-ecg/coding-standard
- Zend Coding Standard
- PSR1 plus PSR2 (PHP-FIG)
- Validation in IDE
    - PhpStorm
    - Zend Studio

---
# Testing Concepts
* Unit Testing - Code Coverage
* Continuous Integration
* TDD (Test Driven Development)

---
# Unit Testing
- Which data?
    - Production site
    - Testing site
    - Dummy data
- Approaches
    - EcomDev_PHPUnit
    - Custom Magento bootstrap loader

---
# Testing tools
* Basic tools
    - Selenium
    - PHPUnit
* Continuous Integration
    - Jenkins

---
# Other useful tools
- `maldet` = malware scanner
- https://shoplift.byte.nl
- profilers
    - Zend Server Z-Ray
    - New Relic
    - Blackfire

---
# Quality of hosting
- PHP version
    - PHP 5.4 is going to be obsolete in September 2015
    - PHP 7 is upcoming in December 2015 (PHP-NG)
    - HipHop VM (HHVM) is also nice
- Magento tools
    - Redis
    - `magerun`, `composer`

---
# Measuring performance
- Application time
    - HTML document only (Magento)
- Page time
    - Entire webpage (CSS, JS, images)

---
# Measuring tools
- Complete page analysis
    - Pingdom
    - GTMetrix
    - http://www.magespeedtest.com
    - Google PageSpeed analysis
- Do it yourself
    - sitespeed.io
    - siege, JMeter, ApacheBench, Httperf

---
# Magento: The Right Way
https://magentotherightway.com/

---
# Yireo self-promotion
- Extensions
    - Yireo NewRelic (free)
    - Yireo SystemInfo (free)
- Services
    - Magento Performance Insights
    - Code Reviews as a service
- Training
    - Magento Performance Masterclass
        - 09 september (full), 08 december (open)
    - Magento 2 Development
        - december / january (pending)

---
class: center, middle
### done
