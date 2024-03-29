layout: true
<div class="slide-heading">Best coding practices</div>
<div class="slide-footer">
    <span>#mm18nyc | @yireo | @jissereitsma</span>
</div>

---
class: center, middle
# Best coding practices
### according to ExtDN

---
# Jisse Reitsma
~ A simple Dutch boy
~ From the Netherlands (a real country!)
~ Founder of Yireo
~ Extension developer
~ Trainer of Magento 2 developers
~ Creator of MageTestFest & Reacticon
~ Magento Master 2017 & 2018 Mover
~ Member of ExtDN.org

---
class: center, middle
# ExtDN
### https://extdn.org/

---
# ExtDN Working Groups
- Extension Quality
- Interoperability
- Communications

---
# ExtDN Working Groups
- Extension Quality
    - Collaboration with Magento Marketplace
    - PHP CodeSniffer
- Interoperability
- Communications
    
---
# ExtDN Working Groups
- Extension Quality
- Extension Interoperability
    - Less conflicts between extensions
    - Expectation of features
    - PWA compatibility
- Communications

---
# ExtDN Working Groups
- Extension Quality
- Extension Interoperability
- Communications
    - Talk with each other
    - Talk with Magento & Adobe
    - Talk with you

---
# Some of the goals
~ Better extension quality
~ Less bugs, less conflicts
~ More happiness

---
class: center, middle
# 8 points

---
class: center, middle
# 8 fold path
### to achieve happiness

---
# 8 points
~ Do Use Composer
~ Do Use Service Contracts
~ Do Write Tests
~ Do Document Your Dependencies
~ Do Version Releases
~ Do Provide A User Manual
~ Do Use Events And Plugins
~ Do Check Your Code

---
class: center, middle
# 1. Do Use Composer

---
# 1. Do Use Composer
"Use composer packages to distribute (especially commercial) extensions. For a local environment, it is fine to develop your own code under app/code. However, once you distribute your module to other environments, it should be through composer as otherwise dependencies are left unmanaged. In a production environment, the app/code folder should therefore ideally be empty."

---
# 1. Do Use Composer
~ Use composer packages for extensions
~ Especially commercial extensions should use composer
~ This is not a debate, this is a base requirement

---
# 1. Do Use Composer
~ Locally, you can use `app/code`
~ But with deployment, composer should be used
~ And in production, `app/code` should be empty

---
class: center, middle
# 4. Do Document Your Dependencies

---
# 4. Document Dependencies
"If your module depends on other modules, make sure that both your composer file and your module.xml file reflect this. If your module only depends on the Magento framework, your module should likely be treated as a library, not a module. Your composer version constraints should respect the semantic versioning standards of Magento."

---
# 4. Document Dependencies
File `etc/module.xml`:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="Yireo_Foobar" setup_version="0.0.1" />
</config>
```

---
# 4. Document Dependencies
File `etc/module.xml`:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="Yireo_Foobar" setup_version="0.0.1">
        <sequence>
            <module name="Magento_Catalog" />
        </sequence>
    </module>
</config>
```

---
# 4. Document Dependencies
File `etc/module.xml`:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="Yireo_Foobar" setup_version="0.0.1">
        <sequence>
            <module name="Magento_Catalog" />
            <module name="Magento_Backend" />
        </sequence>
    </module>
</config>
```

---
# 4. Document Dependencies
File `etc/module.xml`:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="Yireo_Foobar" setup_version="0.0.1">
        <sequence>
            <module name="Magento_Catalog" />
            <module name="Magento_Backend" />
            <module name="Magento_Ui" />
        </sequence>
    </module>
</config>
```

---
# 4. Document Dependencies
File `etc/module.xml`:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
    <module name="Yireo_Foobar" setup_version="0.0.1">
        <sequence>
            <module name="Magento_Catalog" />
            <module name="Magento_Backend" />
            <module name="Magento_Ui" />
            <module name="Magento_Store" />
        </sequence>
    </module>
</config>
```

---
# 4. Document Dependencies
File `composer.json`:
```json
  "require": {
    "magento/framework": "^100.1|^101.0|^102.0",
    "magento/module-backend": "^101.0|^102.0",
    "magento/module-catalog": "^100.0|^101.0",
    "magento/module-store": "^100.1|^101.0",
    "magento/module-ui": "^101.0",
    "php": ">=7.0.0"
  },
```

---
class: center, middle
# 8. Do Check Your Code

---
# 8. Do Check Your Code
"Use a static analysis tool like PHP CodeSniffer (with the ExtDN and MEQP rulesets). Check whether your extension works in Production Mode. Confirm your extension works under the Magento versions that you claim compatibility with. Have a colleague or friend review your code before releasing it."

---
# 8. Do Check Your Code
- PHP CodeSniffer

---
# 8. Do Check Your Code
- PHP CodeSniffer
    - PSR1, PSR2
    - Magento Extension Quality Program
    - Magento Expert Consultancy Group
    - ExtDN
    - Object Calisthenics

---
# 8. Do Check Your Code
- PHP CodeSniffer
~ PHPStan
~ GrumPHP
~ roave/security-advisories
~ Linting
~ Testing (unit, integration, functional, acceptance)

---
# 8. Do Check Your Code
Not just tools:
- Code reviews, extension reviews
- Pair programming, crown programming
- Hackathons, Contribution Days

---
class: center, middle
# ExtDN PHPCS project
https://github.com/extdn/extdn-phpcs

---
class: center, middle
## <span style="color:#777">stop bitching</span><br/>start contributing

---
class: center, middle
## <span style="color:#777">stop complaining</span><br/>start contributing

---
class: center, middle
## thanks