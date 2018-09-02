{state: main}
## Adding React to the current Knockout frontend
# There and back again

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
# Who is the evil Dale Cooper?
<table>
<tr>
<td><img src="/images/mm18pl/dale-cooper-good.jpg" ></td>
<td><img src="/images/mm18pl/dale-cooper-bad.jpg" ></td>
</tr>
</table>

---
# Who is the evil Ash from Evil Dead?
<table>
<tr>
<td><img src="/images/mm18pl/ash-good.jpg" ></td>
<td><img src="/images/mm18pl/ash-bad.jpg" ></td>
</tr>
</table>

---
# Who is the evil Polish president?
<table>
<tr>
<td><img src="/images/mm18pl/president-good.jpg" ></td>
<td><img src="/images/mm18pl/president-bad.jpg" ></td>
</tr>
</table>

---
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
# Minicart React component
- Gulp to compile ES6+React code into plain ES5 files
- KO listener to re-render React component when customerData.get('cart') changes
- toggling of dropdown based on React click-handler and state, not complex UiComponent
- simple CustomerData object to copy data from localStorage

---
# Current limitations
- No support for text translations (yet)
- No way to send state back to KO ViewModels (?)