{state: main}
## Adding React to the current Knockout frontend
# 'cause it needs to be better
#### by Jisse Reitsma (Yireo)

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
{state: main}
# Knockout Gate

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
# Who is
## the evil Dale Cooper?
<table>
<tr>
<td><img src="/images/mm18pl/dale-cooper-good.jpg" ></td>
<td><img src="/images/mm18pl/dale-cooper-bad.jpg" ></td>
</tr>
</table>

---
{state: quiz}
# Who is 
## the evil Ash from Evil Dead?
<table>
<tr>
<td><img src="/images/mm18pl/ash-good.jpg" ></td>
<td><img src="/images/mm18pl/ash-bad.jpg" ></td>
</tr>
</table>

---
{state: quiz}
# Who is 
## the evil politician?
<table>
<tr>
<td><img src="/images/magetitans-uk/trump.jpg" ></td>
<td><img src="/images/magetitans-uk/boris.jpg" ></td>
</tr>
</table>

---
{state: quiz}
{class: center}
# Which one is 
## the evil UiComponent?
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
{state: dark}
{background-image: mm18pl/knockout.jpg}
# Summary of Knockout
~ Initial release in 2010
~ Back then, a better alternative to Angular
~ Now superseeded by other solutions
    - React
    - Vue
    - Polymer
    - Web Components

---
{state: dark}
{background-image: mm18pl/man-crying.jpg}
# Summary of UiComponents
~ Combination of technologies
    - XML Layout + Blocks + PHTML templating
    - RequireJS + mixins
    - KnockoutJS + HTML templates
    - Custom Magento logic
~ Overly complex

---
{state: dark}
# Minicart UiComponent
~ XML layout, Block class and PHTML template generate JSON blob
~ `x-magento-init` uses JSON blob to initialize UiComponent `minicart.js`
~ UiComponent `minicart.js` creates KO ViewModel definition
~ KO ViewModel is instantiated and bound to `scope: minicart_content`
~ `customerData` cart details are received from AJAX or localStorage
~ UiComponent calls upon child ViewModels + templates

---
{class: center}
# What if we could migrate?
{background-image: mm18pl/migrate.jpg}

---
{state: dark}
{class: center}
# ... to React
~ Modern JS framework
~ Simpler to work with, once you get the hang
~ JS, HTML, CSS - all combined in 1 single component
~ Used by upcoming PWA techs like Magento PWA Studio

---
{state: light}
{class: center}
<div style="text-align:center">
<img src="/images/mm18pl/github.png" style="height:30%; width:30%;"/>
<h1 style="text-align:center">GitHub repo</h1>
<h3 style="text-align:center">https://github.com/yireo-training/Yireo_ReactMinicart</h3>
</div>

---
{state: light}
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
{state: light}
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
{state: light}
# Migration method for Minicart
~ Copy real-life HTML from Element Inspector
~ Remove all KO parts
	- Remove all KO comments (containerless bindings)
	- Remove all element bindings (`data-bind=`)

---
{state: light}
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
{state: light}
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
{state: light}
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
{state: light}
# PHTML template
```php
<div class="react-minicart-wrapper" data-mage-init='{"reactMinicart":{}}'>
    <a class="action showcart" href="/checkout/cart/">
        <span class="text"><?= __('My Cart') ?></span>
    </a>
</div>
```

---
{state: light}
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
{state: light}
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
{state: light}
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
{state: light}
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
# Kat in het bakkie
{background-image: mm18pl/cat.jpg}
    
---
{state: light}
# Minicart React component
- Gulp to compile ES6+React code into plain ES5 files
- KO listener to re-render React component when customerData.get('cart') changes
- Dropdown based on React click-handler and state, not complex UiComponent
- Simple CustomerData object to copy data from localStorage


---
{state: dark}
# Current limitations
- No support for text translations (yet)
- No way to send state back to KO ViewModels (?)

---
{state: dark}
# Lessons learned
~ Knockout sucks, React sucks less
~ You can gradually add React components to existing frontend
~ Once Magento 2.3 is out, start playing with GraphQL too

---
{state: bordered}
{background-image: mm18pl/ross-kemp-folded.jpg}
# Slides
## slides.yireo.com/yireo/react_to_ko