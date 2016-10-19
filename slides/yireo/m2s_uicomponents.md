class: center, middle
# KnockoutJS & RequireJS
### in one Magento 2 UIcomponent

---
class: center, middle
### or
# UIComponents

---
# Diving into UIComponents
- XML Layout
- Block classes
- PHTML templates
- RequireJS
- KnockoutJS
- HTML templates

---
# Note
All files are in `Module_Checkout` (`vendor/magento/module-checkout` folder) unless mentioned otherwise

---
# Note
Do not copy my code. Instead, review the core.

---
# PHTML template (1 of 3)
`view/frontend/templates/cart/minicart.phtml`:
```html
<div data-block="minicart">
    <a data-bind="scope: 'minicart_content'">
        <span
            data-bind="css: { empty: 
            !!getCartParam('summary_count') == false } 
            ">
            ...
        </span>
    </a>
```

Where does `getCartParam()` come from?

---
# PHTML template (2 of 3)
`view/frontend/templates/cart/minicart.phtml`:
```html
<div id="minicart-content-wrapper"
    data-bind="scope: 'minicart_content'">
    <!-- ko template: getTemplate() --><!-- /ko -->
</div>
```

Where does `getTemplate()` come from?

---
# XML layout
`view/frontend/layout/default.xml`:
```xml
<block class="Magento\Checkout\Block\Cart\Sidebar" 
 name="minicart" as="minicart" 
 after="logo" template="cart/minicart.phtml">
 <arguments>
  <argument name="jsLayout">
   <item name="components">
    <item name="minicart_content">
     <item name="component">Magento_Checkout/js/view/minicart</item>
     <item name="config">
      <item name="template">Magento_Checkout/minicart/content</item>
      </item>
      ...
```

---
# Block class
`Block/Cart/Sidebar.php`:
```php
public function __construct(
    ...
    array $data = []
    ) {
    if (isset($data['jsLayout'])) {
        $this->jsLayout = ...
        unset($data['jsLayout']);
    } else {
        $this->jsLayout = ...
    }
```

---
# PHTML template (3 of 3)
`view/frontend/templates/cart/minicart.phtml`:
```html
<script type="text/x-magento-init">
{
  "[data-block='minicart']": {
   "Magento_Ui/js/core/app": &lt;?= $block->getJsLayout();?>
  }
}
</script>
```

Take note of parent block:
```html
<div data-block="minicart">
```

---
# Tracing JS functions
- Locate JS component
- Find JS functions in current or parent class
    - `getCartParam()`
    - `getTemplate()`

---
# JS component (1 of 3)
`view/frontend/web/js/view/minicart.js`:
```js
define(['uiComponent', 'Magento_Customer/js/customer-data',
  'jquery', 'ko', 'underscore', 'sidebar'
], function (Component, customerData, $, ko, _) {
  'use strict';
  return Component.extend({
    getCartParam: function (name) { ... }
  });
});
```
We found `getCartParam`!

---
# JS component (2 of 3)
- `minicart` component extends from `uiComponent`
    - Located in `Magento_Ui/js/core/app`
- `uiComponent` extends from `uiElement`
    - Located in `Magento_Ui/js/lib/core/element/element.js`
    - Contains `getTemplate()`

We found `getTemplate`!

---
# JS component (3 of 3)
`Magento_Ui/js/lib/core/element/element.js`
```js
getTemplate: function () {
  return this.template;
},
```

---
# Minicart contents (1 of 2)
PHTML template:
```html
<!-- ko template: getTemplate() --><!-- /ko -->
```

XML layout:
```xml
<item name="template">
  Magento_Checkout/minicart/content</item>
</item>
```
---
# Minicart contents (2 of 2)
HTML template `minicart/content.html` in folder `view/frontend/web/template/`:
```html
<div class="block-title">
  <strong>
    <span class="text">
      <!-- ko i18n: 'My Cart' --><!-- /ko -->
    </span>
    ...
```

---
# JS component dependencies
```js
define(['uiComponent', 'Magento_Customer/js/customer-data',
  'jquery', 'ko', 'underscore', 'sidebar'
], function (Component, customerData, $, ko, _) {
```

Where do these dependencies come from?

---
# uiComponent
`Magento_UI` file `view/base/require-config.js`:
```js
var config = {
  map: {
    '*': {
      uiElement: 'Magento_Ui/js/lib/core/element/element',
      uiComponent: 'Magento_Ui/js/lib/core/collection'
    }
  }
};
```

---
# dropdownDialog
`Magento_Theme` file `view/frontend/require-config.js`:
```js
var config = {
  map: {
    '*': {
      "dropdownDialog": "mage/dropdown",
    }
  }
};
```

Translates to `/lib/web/mage/dropdown.js`

---
# Extending PHTML
`view/frontend/templates/cart/minicart.phtml`:
```php
&lt;?php echo $block->getChildHtml('minicart.addons'); ?>
```

`view/frontend/layout/default.xml` shows this block is a container.

XML modification:
```
    <referenceContainer name="minicart.addons">
        <block ... />
    </referenceContainer>
```

---
# Modifying things
- Override of HTML (KnockoutJS) template
- Override of PHTML template
- Replacing JS component (and extending original)
- Adding your own JS component as child component
- Adding new parameters via XML layout
- Replacing block dependencies using DI configuration

---
class: center, middle
### UIComponents allow for
### awesome modifications
