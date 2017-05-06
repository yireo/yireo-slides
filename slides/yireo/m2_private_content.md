layout: true
<div class="slide-heading">M2 Private Data via JS Components</div>
<div class="slide-footer">
    <span>M2 Private Data via JS Components - Jisse Reitsma - Meet Magento NL 2017</span>
</div>

---
class: center, middle, world, bgimage
# Magento 2 Private Data
## via JS Components

Meet Magento Netherlands 2017

---
class: center, middle
### This slide is made possible with RemarkJS

---
class: center, middle
### This slide too

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
- Private Content
    - Hole punching in FPC (M2)
--
- JS Components
    - RequireJS
    - KnockoutJS

---
# Full Page Cache

--
- Shipped out of the box with M2

--
- For both CE and EE

--
- Native Magento cache or Varnish Cache

---
# Optimizations

--
- Make sure no blocks are using `cacheable=false`

--
- Enable FPC with Magento caching
    - 50-100 ms
--
- Set caching handler to Redis (or memcache)
    - 10-50 ms
--
- Switch to Varnish
    - 5-10 ms

---
# cacheable=false
```xml
<layout>
  <referenceBlock name="category.products.list">
    <arguments>
      <argument name="cacheable" xsi:type="bool">false</argument>
    </arguments>
  </referenceBlock>
</layout>
```

--
If you do this, you are a bastard

---
class: orange, center, middle
# `cacheable=false`
# is in top 5 issues
for Magento Marketplace extensions

---
# Checking for FPC
- Enable FPC
- Open up Error Console and check for HTTP headers
- FPC is working
    - `X-Magento-Cache-Control: MISS`
    - `X-Magento-Cache-Control: HIT`
- FPC is not working
    - `X-Magento-Cache-Control: MISS`
    - `X-Magento-Cache-Control: MISS`

---
# Reasons `cacheable=false`
- Bad third party modules
- Module `Magento_Captcha` is enabled
- You are in Catalog Search result pages
- You are comparing products
- You are in the checkout or in the cart
- You are in customer pages

---
# Hole punching with M2
- No ESI Includes, no VCL tricks
- Just plain JavaScript lazy loading

---
# Private Content
- Print dummy HTML in PHTML template
- Load JS component in RequireJS
- Extend from `UiComponent`
- Load data from `customerData` component
- Let Knockout replace data in PHTML template

---
# Module files
- `etc/module.xml` + `registration.php`
- `view/frontend/layout/foobar.xml`
- `Block/Foobar.php`
- `view/frontend/template/foobar.phtml`
- `view/frontend/requirejs-config.js`
- `view/frontend/web/js/foobarComp.js`
- `etc/di.xml`
- `CustomerData/PersonalizedFoobar.php`

---
class: orange, center, middle
### Disclaimer: This code is not 100% halal

---
# Private content
File `Block/Foobar.php`
```php
namespace Yireo\Example\Block;

class Foobar extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'foobar.phtml';
}
```

---
# Private content
File `view/frontend/layout/foobar.xml`
```xml
 <block class="Yireo\Example\Block\Foobar" name="foobar">
    <arguments>
        <argument name="jsLayout" xsi:type="array">
            <item name="components" xsi:type="array">
                <item name="fooBarComp" xsi:type="array">
                    <item name="component" xsi:type="string">
                        foobarComp
                    </item>
                </item>
            </item>
        </argument>
    </arguments>
</block>
```

---
# Private content
File `view/frontend/template/foobar.phtml`
```html
<div data-bind="scope: 'fooBarComp'" id="foobarElement">
    <span data-bind="text: secret_number">0</span>
</div>
```

```php
<script type="text/x-magento-init">
{
    "#foobarElement": {
        "Magento_Ui/js/core/app": &lt;?php echo $block->getJsLayout();?>
    }
}
</script>
```

---
# Private content
File `view/frontend/requirejs-config.js`:
```js
var config = {
    path: {
        '*': {
            foobarComp: 'Yireo_Example/js/foobarComp',
        }
    }
};
```

---
# Private content
File `view/frontend/web/js/foobarComp.js`
```js
define([
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (Component, customerData) {
    ...
    return Component.extend({
        initialize: function () {
            this._super();
            this.fooBarComp = customerData.get('fooBarData');
        }
    });
});
```

---
# Private content
File `etc/di.xml`
```xml
<type name="Magento\Customer\CustomerData\SectionPoolInterface">
    <arguments>
        <argument name="sectionSourceMap" xsi:type="array">
            <item name="fooBarData" xsi:type="string">
                Yireo\Example\CustomerData\PersonalizedFoobar
            </item>
        </argument>
    </arguments>
</type>
```

---
# Private content
File `CustomerData/PersonalizedFoobar.php`
```php
namespace Yireo\Example\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;

class PersonalizedFoobar implements SectionSourceInterface
{
    public function getSectionData()
    {
        return ['secret_number' => '42'];
    }
}
```


---
class: orange, center, middle
# ...

---
<div>
So, we have defined a module with a simple module.xml and a registration.php file, 
to call upon a regular flow of XML layout, to define a Block class that is outputted
into a PHTML template, which is then outputting a JSON configuration array, that was 
inserted into the Block class, using an XML argument-array, and which is then used
to initialize a custom AMD-style JS component, initialized through another component
Magento_Ui/js/core/app which connects our JS component to our KnockoutJS component.
Our JS component then injects the customer-data component, to collect a thing called
foobarData, which is fetched through a kind of localStorage-cached AJAX-call to the backend
which is configured through a DI type that injects an array of section sources into
a backend class, that fetches data from various sources, including our own, to then
send back a bundled response, if possible, to the JS component, with the major feature
being JavaScript AJAX lazy loading.
</div>

---
class: orange, center, middle
# WTF

---
class: orange, center, middle
# (W)onderful. (T)echnology. (F)un.

---
# Tips
- Learn about RequireJS & KnockoutJS
- Take your time to read through devdocs
    - Or learn from a training
- Do not use extensions with `cacheable=false`

---
class: orange, center, middle
# WTF 

---
class: orange, center, middle
# MTF

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
- Somewhere in The Netherlands

--
- 5 awesome speakers

--
- 1st announcement: Vinai Kopp

--
- [magetestfest.nl](https://magetestfest.nl/)

---
class: center, middle, world
# Any questions?
### @yireo
### @jissereitsma

