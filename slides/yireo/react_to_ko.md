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
# Migrate to React
~ Modern JS framework
~ Simpler to work with, once you get the hang
~ JS, HTML, CSS - all combined in 1 single component
~ Used by upcoming PWA techs like Magento PWA Studio

---
# Minicart UiComponent
- XML layout, Block class and PHTML template generate JSON blob
- `x-magento-init` uses JSON blob to initialize UiComponent `minicart.js`
- UiComponent `minicart.js` creates KO ViewModel definition
- KO ViewModel is instantiated and bound to `scope: minicart_content`
- UiComponent calls upon child ViewModels
- About 

---
# Minicart HTML
```html
<div id="minicart-content-wrapper" data-bind="scope: 'minicart_content'"><!-- ko template: getTemplate() -->
<div class="block-title">
    <strong>
        <span class="text" data-bind="i18n: 'My Cart'">My Cart</span>
        <span class="qty" data-bind="css: { empty: !!getCartParam('summary_count') == false },
                       attr: { title: $t('Items in Cart') }, text: getCartParam('summary_count')" title="Items in Cart">1</span>
    </strong>
</div>

<div class="block-content">
    <button type="button" id="btn-minicart-close" class="action close" data-action="close" data-bind="attr: { title: $t('Close') }" title="Close">
        <span data-bind="i18n: 'Close'">Close</span>
    </button>

    <!-- ko if: getCartParam('summary_count') -->
        <div class="items-total">
            <!-- ko if: maxItemsToDisplay < getCartLineItemsCount() --><!-- /ko -->
            <!-- ko if: maxItemsToDisplay < getCartLineItemsCount() --><!-- /ko -->
            <span class="count" data-bind="text: getCartLineItemsCount()">1</span>
            <!-- ko if: getCartLineItemsCount() === 1 --><!-- ko i18n: 'Item in Cart' --><span>Item in Cart</span><!-- /ko --><!-- /ko -->
            <!-- ko if: getCartLineItemsCount() > 1 --><!-- /ko --></div>

        <!-- ko foreach: getRegion('subtotalContainer') --><!-- ko template: getTemplate() -->
<!-- ko foreach: {data: elems, as: 'element'} -->
    <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
<div class="subtotal">
    <span class="label">
        <!-- ko i18n: 'Cart Subtotal' --><span>Cart Subtotal</span><!-- /ko -->
    </span>

    <!-- ko foreach: elems -->
        <!-- ko template: getTemplate() -->

<div class="amount price-container">
    <!-- ko if: displaySubtotal() -->
        <!-- ko if: display_cart_subtotal_excl_tax -->
            <span class="price-wrapper" data-bind="html: cart().subtotal_excl_tax"><span class="price">$57.00</span></span>
        <!-- /ko -->

        <!-- ko if: !display_cart_subtotal_excl_tax && display_cart_subtotal_incl_tax --><!-- /ko -->

        <!-- ko if: !display_cart_subtotal_excl_tax && !display_cart_subtotal_incl_tax --><!-- /ko -->
    <!-- /ko -->
    <!-- ko ifnot: displaySubtotal() --><!-- /ko -->
</div>
<!-- /ko -->
    <!-- /ko -->
</div>
<!-- /ko --><!-- /ko -->
<!-- /ko -->
<!-- /ko --><!-- /ko -->
        <!-- ko foreach: getRegion('extraInfo') --><!-- ko template: getTemplate() -->
<!-- ko foreach: {data: elems, as: 'element'} --><!-- /ko -->
<!-- /ko --><!-- /ko -->

        <!-- ko if: getCartParam('possible_onepage_checkout') --><div class="actions">
            <div class="primary">
                <button id="top-cart-btn-checkout" type="button" class="action primary checkout" data-action="close" data-bind="
                            attr: {
                                title: $t('Proceed to Checkout')
                            },
                            click: closeMinicart()
                        , i18n: 'Proceed to Checkout'" title="Proceed to Checkout">Proceed to Checkout</button>
                <div data-bind="html: getCartParam('extra_actions')"></div>
            </div>
        </div><!-- /ko -->
    <!-- /ko -->

    <!-- ko if: getCartParam('summary_count') -->
        <strong class="subtitle" data-bind="i18n: 'Recently added item(s)'">Recently added item(s)</strong>
        <div data-action="scroll" class="minicart-items-wrapper" style="height: 140px;">
            <ol id="mini-cart" class="minicart-items" data-bind="foreach: { data: getCartItems(), as: 'item' }">
                <!-- ko foreach: $parent.getRegion($parent.getItemRenderer(item.product_type)) --><!-- ko template: {name: getTemplate(), data: item, afterRender: function() {$parents[1].initSidebar()}} -->
<li class="item product product-item odd last" data-role="product-item" data-collapsible="true">
    <div class="product">
        <!-- ko if: product_has_url -->
        <a data-bind="attr: {href: product_url, title: product_name}" tabindex="-1" class="product-item-photo" href="http://magento4.yr/mona-pullover-hoodlie.html" title="Mona Pullover Hoodlie">
            <!-- ko foreach: $parent.getRegion('itemImage') -->
                <!-- ko template: {name: getTemplate(), data: item.product_image} -->
<span class="product-image-container" data-bind="style: {width: width + 'px'}" style="width: 75px;">
    <span class="product-image-wrapper" data-bind="style: {'padding-bottom': height/width*100 + '%'}" style="padding-bottom: 100%;">
        <img class="product-image-photo" data-bind="attr: {src: src, alt: alt}, style: {width: width + 'px', height: height + 'px'}" src="http://magento4.yr/pub/media/catalog/product/cache/fd4c882ce4b945a790b629f572e4ef93/w/h/wh01-green_main.jpg" alt="Mona Pullover Hoodlie" style="width: 75px; height: 75px;">
    </span>
</span>
<!-- /ko -->
            <!-- /ko -->
        </a>
        <!-- /ko -->
        <!-- ko ifnot: product_has_url --><!-- /ko -->

        <div class="product-item-details">
            <strong class="product-item-name">
                <!-- ko if: product_has_url -->
                <a data-bind="attr: {href: product_url}, html: product_name" href="http://magento4.yr/mona-pullover-hoodlie.html">Mona Pullover Hoodlie</a>
                <!-- /ko -->
                <!-- ko ifnot: product_has_url --><!-- /ko -->
            </strong>

            <!-- ko if: options.length -->
            <div class="product options" data-collapsible="true" role="tablist">
                <span data-role="title" class="toggle" role="tab" aria-selected="false" aria-expanded="false" tabindex="0"><!-- ko i18n: 'See Details' --><span>See Details</span><!-- /ko --></span>

                <div data-role="content" class="content" role="tabpanel" aria-hidden="true" style="display: none;">
                    <strong class="subtitle"><!-- ko i18n: 'Options Details' --><span>Options Details</span><!-- /ko --></strong>
                    <dl class="product options list">
                        <!-- ko foreach: { data: options, as: 'option' } -->
                        <dt class="label"><!-- ko text: option.label -->Size<!-- /ko --></dt>
                        <dd class="values">
                            <!-- ko if: Array.isArray(option.value) --><!-- /ko -->
                            <!-- ko ifnot: Array.isArray(option.value) -->
                                <span data-bind="html: option.value">M</span>
                            <!-- /ko -->
                        </dd>
                        
                        <dt class="label"><!-- ko text: option.label -->Color<!-- /ko --></dt>
                        <dd class="values">
                            <!-- ko if: Array.isArray(option.value) --><!-- /ko -->
                            <!-- ko ifnot: Array.isArray(option.value) -->
                                <span data-bind="html: option.value">Green</span>
                            <!-- /ko -->
                        </dd>
                        <!-- /ko -->
                    </dl>
                </div>
            </div>
            <!-- /ko -->

            <div class="product-item-pricing">
                <!-- ko if: canApplyMsrp --><!-- /ko -->
                <!-- ko ifnot: canApplyMsrp -->
                <!-- ko foreach: $parent.getRegion('priceSidebar') -->
                    <!-- ko template: {name: getTemplate(), data: item.product_price, as: 'price'} -->
<div class="price-container">
  <span class="price-wrapper" data-bind="html: price">                <span class="price-wrapper price-excluding-tax" data-label="Excl. Tax">
            <span class="price">$57.00</span>        </span>
    </span>
</div>
<!-- /ko -->
                <!-- /ko -->
                <!-- /ko -->

                <div class="details-qty qty">
                    <label class="label" data-bind="i18n: 'Qty', attr: {
                           for: 'cart-item-'+item_id+'-qty'}" for="cart-item-15-qty">Qty</label>
                    <input data-bind="attr: {
                           id: 'cart-item-'+item_id+'-qty',
                           'data-cart-item': item_id,
                           'data-item-qty': qty,
                           'data-cart-item-id': product_sku
                           }, value: qty" type="number" size="4" class="item-qty cart-item-qty" id="cart-item-15-qty" data-cart-item="15" data-item-qty="1" data-cart-item-id="WH01-M-Green">
                    <button data-bind="attr: {
                           id: 'update-cart-item-'+item_id,
                           'data-cart-item': item_id,
                           title: $t('Update')
                           }" class="update-cart-item" style="display: none" id="update-cart-item-15" data-cart-item="15" title="Update">
                        <span data-bind="i18n: 'Update'">Update</span>
                    </button>
                </div>
            </div>

            <div class="product actions">
                <!-- ko if: is_visible_in_site_visibility -->
                <div class="primary">
                    <a data-bind="attr: {href: configure_url, title: $t('Edit item')}" class="action edit" href="http://magento4.yr/checkout/cart/configure/id/15/product_id/1049/" title="Edit item">
                        <span data-bind="i18n: 'Edit'">Edit</span>
                    </a>
                </div>
                <!-- /ko -->
                <div class="secondary">
                    <a href="#" data-bind="attr: {'data-cart-item': item_id, title: $t('Remove item')}" class="action delete" data-cart-item="15" title="Remove item">
                        <span data-bind="i18n: 'Remove'">Remove</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</li>
<!-- /ko --><!-- /ko -->
            </ol>
        </div>
    <!-- /ko -->

    <!-- ko ifnot: getCartParam('summary_count') --><!-- /ko -->

    <!-- ko if: getCartParam('summary_count') --><div class="actions">
        <div class="secondary">
            <a class="action viewcart" data-bind="attr: {href: shoppingCartUrl}" href="http://magento4.yr/checkout/cart/">
                <span data-bind="i18n: 'View and Edit Cart'">View and Edit Cart</span>
            </a>
        </div>
    </div><!-- /ko -->

    <div id="minicart-widgets" class="minicart-widgets">
        <!-- ko foreach: getRegion('promotion') --><!-- ko template: getTemplate() -->
<!-- ko foreach: {data: elems, as: 'element'} --><!-- /ko -->
<!-- /ko --><!-- /ko -->
    </div>
</div>
<!-- ko foreach: getRegion('sign-in-popup') --><!-- /ko -->
<!-- /ko -->
            </div>
```

---
# Migration method
~ Copy real-life HTML from Element Inspector
~ Remove all KO parts
	- Remove all KO comments (containerless bindings)
	- Remove all element bindings (`data-bind=`)
~ Start copying HTML to React component (and subcomponents)
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