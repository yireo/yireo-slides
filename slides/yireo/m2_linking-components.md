layout: true
<div class="slide-heading">M2 Linking JS Components</div>
<div class="slide-footer">
    <span>M2 Linking JS Components - Jisse Reitsma - Meet Magento PL 2017</span>
</div>

---
class: center, middle, world, bgimage
# Magento 2
## Linking JS Components

Meet Magento Poland 2017

---
class: center, middle
### This slide is made possible with RemarkJS

???
Reminder: Make a silly joke on that this slide is using RemarkJS and refer to these student notes as an example.

---
class: center, middle
### This slide is also made possible with RemarkJS

---
class: orange
# About me
- Jisse Reitsma
--

- Founder and lead developer of Yireo
--

- Trainer, enterpreneur, coder
--

- Magento 2 Master "Mover" (2017)
--

- Knockout JiSse (I don't why)
--

- Loving Magento 2

---
# My talk
- JS Components
    - RequireJS
    - KnockoutJS
--
- Linking Components
    - imports
    - exports
    - links
--
- Personal opinion on this

---
class: center, middle
## Sample module
### [yireo-training/magento2-example-component-linking](https://github.com/yireo-training/magento2-example-component-linking)

---
# Sample module
- `etc/module.xml`
- `registration.php`
- `view/frontend/layout/default.xml`
- `view/frontend/templates/example.phtml`
- `view/frontend/requirejs-config.js`
- `view/frontend/web/js/component1.js`
- `view/frontend/web/js/component2.js`

---
# XML layout
File `view/frontend/layout/default.xml`:
```xml
<?xml version="1.0" encoding="utf-8" ?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceContainer name="content">
            <block class="Magento\Framework\View\Element\Template" name="component-linking" template="Yireo_ExampleComponentLinking::example.phtml">
            </block>
        </referenceContainer>
    </body>
</page>
```

---
# PHTML template
File `view/frontend/templates/example.phtml`:
```php
```

---
class: orange, center, middle
<h1 class="magetestfest"><span>Mage</span><span>Test</span><span>Fest</span></h1>

---
<h1 class="magetestfest">Mage Test Fest</h1>

--
- Magento. Software Testing. Party.

--
- November 15th-18th 2017

--
- Prodent Factory, Amersfoort, The Netherlands

--
- 7 awesome speakers

--
- [magetestfest.com](https://magetestfest.com/)

---
class: center, middle, world
# Any questions?
### @yireo
### @jissereitsma

