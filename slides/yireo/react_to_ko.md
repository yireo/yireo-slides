{state: main}
## Adding React to the current Knockout frontend
# There and back again
#### by Jisse Reitsma

---
{state: speaker}
{background-image: mm18pl/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of Magento 2 developers
~ Creator of MageTestFest & Reacticon
~ Organizer of usergroups, hackathons
~ Magento Master 2017 & 2018 Mover
~ For some reason, called **Knockout Jisse**

---
{background-image: mm18pl/drinking.jpg}

---
{background-image: mm18pl/eye-double.jpg}

---
{state: main}
# Doppelganger
### an apparition or double of a living person.

---
{state: quiz}
# Who is the evil Dale Cooper?
<table>
<tr>
<td><img src="/images/mm18pl/dale-cooper-good.jpg" ></td>
<td><img src="/images/mm18pl/dale-cooper-bad.jpg" ></td>
</tr>
</table>

---
{state: quiz}
# Who is the evil Ash from Evil Dead?
<table>
<tr>
<td><img src="/images/mm18pl/ash-good.jpg" ></td>
<td><img src="/images/mm18pl/ash-bad.jpg" ></td>
</tr>
</table>

---
{state: quiz}
# Who is the evil Polish president?
<table>
<tr>
<td><img src="/images/mm18pl/president-good.jpg" ></td>
<td><img src="/images/mm18pl/president-bad.jpg" ></td>
</tr>
</table>

---
{state: quiz}
# What is the evil component?
<table>
<tr>
<td><img src="/images/mm18pl/component-good.png" ></td>
<td><img src="/images/mm18pl/component-bad.png" ></td>
</tr>
</table>

---
{state: main}
## Adding React to the current Knockout frontend
# Replacing the native minicart with a React component

---
# Summary of Knockout
- Initial release in 2010
- Back then, a better alternative to Angular
- Now superseeded by other solutions
    - React
    - Vue
    - Polymer
    - Web Components

---
# Summary of UiComponents
~ Combination of technologies
    - XML Layout + Blocks + PHTML templating
    - RequireJS + mixins
    - KnockoutJS + HTML templates
    - Custom Magento logic
~ Overly complex

---
# Minicart UiComponent
~ XML layout, Block class and PHTML template generate JSON blob
~ `x-magento-init` uses JSON blob to initialize UiComponent `minicart.js`
~ UiComponent `minicart.js` creates KO ViewModel definition
~ KO ViewModel is instantiated and bound to `scope: minicart_content`
~ `customerData` cart details are received from AJAX or localStorage
~ UiComponent calls upon child ViewModels + templates

---
# Migrate to React
~ Modern JS framework
~ Simpler to work with, once you get the hang
~ JS, HTML, CSS - all combined in 1 single component
~ Used by upcoming PWA techs like Magento PWA Studio

---
# GitHub repo
## https://github.com/yireo-training/Yireo_ReactMinicart

---
# Module structure (1 of 2)
```
registration.php
etc/module.xml

view/frontend/layout/default.xml
view/frontend/templates/minicart.phtml

view/frontend/requirejs-config.js

view/frontend/web/css/source/_module.less
```

---
# Module structure (2 of 2)
```
view/frontend/web/js/container.js

view/frontend/web/js/react.js
view/frontend/web/js/react-dom.js

view/frontend/package.json
view/frontend/gulpfile.js

view/frontend/source/Minicart.js
view/frontend/web/js/compiled/Minicart.js
```

---
# Migration method for Minicart
~ Copy real-life HTML from Element Inspector
~ Remove all KO parts
	- Remove all KO comments (containerless bindings)
	- Remove all element bindings (`data-bind=`)

---
# Minicart HTML
Old HTML:
```html
<div id="minicart-content-wrapper" data-bind="scope: 'minicart_content'"><!-- ko template: getTemplate() --><div class="block-title"><strong><span class="text" data-bind="i18n: 'My Cart'">My Cart</span><span class="qty" data-bind="css: { empty: !!getCartParam('summary_count') == false }, attr: { title: $t('Items in Cart') }, text: getCartParam('summary_count')" title="Items in Cart">1</span></strong></div>
```

New HTML:
```html
<div id="minicart-content-wrapper"><div class="block-title"><strong><span class="text" >My Cart</span><span class="qty"  title="Items in Cart">1</span></strong></div>
```

---
# Migration method for Minicart
- Copy real-life HTML from Element Inspector
- Remove all KO parts
	- Remove all KO comments (containerless bindings)
	- Remove all element bindings (`data-bind=`)
~ Start copying HTML to React component (and subcomponents)
    - How cool: PhpStorm converts HTML to JSX
~ Make logic dynamic
    - `this.props.cart` is populated from localStorage

---
# requirejs-config.js
```js
var config = {
    map: {
        '*': {
            react: 'Yireo_ReactMinicart/js/react',
            reactDom: 'Yireo_ReactMinicart/js/react-dom',
            reactMinicart: 'Yireo_ReactMinicart/js/container',
            reactMinicartComponent: 'Yireo_ReactMinicart/js/compiled/Minicart',
            reactCustomerData: 'Yireo_ReactMinicart/js/customerData'
        }
    },
    shim: {
        reactMinicartComponent: ['react', 'reactDom']
    }
};
```

---
# PHTML template
```php
<div class="react-minicart-wrapper" data-mage-init='{"reactMinicart":{}}'>
    <a class="action showcart" href="/checkout/cart/">
        <span class="text"><?= __('My Cart') ?></span>
    </a>
</div>
```

---
# container.js
```js
define([
    'react', 'reactDom', 'reactMinicartComponent',
    'Magento_Customer/js/customer-data'
], function(React, ReactDOM, MinicartComponent, customerData) {
    'use strict';
    return function(config, element) {
        var reactElement = React.createElement(MinicartComponent.default);
        ReactDOM.render(reactElement, element);

        customerData.get('cart').subscribe(function() {
            var reactElement = React.createElement(MinicartComponent.default);
            ReactDOM.render(reactElement, element);
        });
    };
});
```

---
# React component source
```js
import CustomerData from './CustomerData';
import React from 'react';
import Cart from "./Minicart/Cart";
import EmptyCart from "./Minicart/EmptyCart";

class Minicart extends React.Component {
    render() {
        var cart = CustomerData.getCartFromLocalStorage();
        return (
            <div>
            ...
            </div>
        );
    }
}
export default Minicart;
```

---
# React components
```js
Minicart
Minicart/Cart
Minicart/Cart/Actions
Minicart/Cart/Product
Minicart/Cart/ProductDetails
Minicart/Cart/Subtotal
Minicart/EmptyCart 
```

---
# Source compilation
gulpfile.js:
```js
gulp.task("build", function () {
    return gulp
        .src(jsFiles.source)
        .pipe(babel())
        .pipe(gulp.dest("web/js/compiled/"));
});
```

.babelrc:
```json
{
  "presets": ["react", "es2015"],
  "plugins": ["transform-es2015-modules-amd"]
}
```
    
---
# Minicart React component
- Gulp to compile ES6+React code into plain ES5 files
- KO listener to re-render React component when customerData.get('cart') changes
- Dropdown based on React click-handler and state, not complex UiComponent
- Simple CustomerData object to copy data from localStorage


---
# Current limitations
- No support for text translations (yet)
- No way to send state back to KO ViewModels (?)

---
# Lessons learned
~ Knockout sucks, React sucks less
~ You can gradually add React components to existing frontend
~ Once Magento 2.3 is out, start playing with GraphQL too

---
# Slides
## slides.yireo.com/yireo/react_to_ko