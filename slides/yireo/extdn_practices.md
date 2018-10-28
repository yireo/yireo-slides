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
~ Founder of Yireo
~ Trainer of Magento 2 developers
~ Creator of MageTestFest & Reacticon
~ Member of ExtDN.org
~ Magento Master 2017 & 2018 Mover


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
- Communications
    - Talk with each other
    - Talk with Magento & Adobe
    - Talk with you

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
# 1. Do Use Composer
"Use composer packages to distribute (especially commercial) extensions. For a local environment, it is fine to develop your own code under app/code. However, once you distribute your module to other environments, it should be through composer as otherwise dependencies are left unmanaged. In a production environment, the app/code folder should therefore ideally be empty."

---
# 1. Do Use Composer
~ Use composer packages for extensions
~ Especially commercial extensions should use composer
~ This is not a debate, this is a base requirement

---
# 1. Do Use Composer
- Use composer packages for extensions
- Especially commercial extensions should use composer
- This is not a debate, this is a base requirement

Moving on ...
~ Locally, you can use `app/code`
~ But with deployment, composer should be used
~ And `app/code` should be empty

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
            <module name="Magento_Backend" />
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
            <module name="Magento_Backend" />
            <module name="Magento_Catalog" />
            <module name="Magento_Store" />
        </sequence>
    </module>
</config>
```

---
# 4. Document Dependencies
File `composer.json`:
```xml

```

---
# 8. Do Check Your Code
"Use a static analysis tool like PHP CodeSniffer (with the ExtDN and MEQP rulesets). Check whether your extension works in Production Mode. Confirm your extension works under the Magento versions that you claim compatibility with. Have a colleague or friend review your code before releasing it."



---
class: center, middle
## thanks
### tweet me via @yireo