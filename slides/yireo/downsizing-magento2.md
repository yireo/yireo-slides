{state: main middle dark}
{background-image: heman/heman-rainbow2.jpg}
# Downsizing Magento 2
## because less is more
### Presented to you by Jisse Reitsma

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of backend and frontend developers
  - Magento, React, PWA Studio, Vue Storefront, GraphQL
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2)
~ Creator of Reacticon v3 (October 2021)
~ Creator of Reacticon v4 (June 2021)
~ Magento Master 2017/2018/2019 Mover
~ Member of ExtDN (Magento Extension Developer Network)
~ Saya suka segalanya di Indonesia

---
{state: main middle dark}
{background-image: heman/greyskull2.jpg}
# Magento of today
# in technical numbers

---
# Magento core of today
~ 519 composer packages
~ 346 modules
~ Numerous features that you might not need

---
# Core features
- GraphQL API
- Multi Source Inventory (MSI)
- Bundled extensions

---
# Bundled extensions
- Amazon
- Braintree
- Dotmailer
- Klarna
- Temando
- Vertex
- Yotpo

---
{state: main middle dark}
{background-image: heman/greyskull2.jpg}
# Removing modules

---
# Disable specific modules
```bash
bin/magento Foo_Bar
```

---
# Disable unneeded modules
```bash
bin/magento bin/magento Magento_AdvancedPricingImportExport Magento_AdminNotification Magento_Authorizenet Magento_Braintree Magento_Bundle Magento_BundleImportExport Magento_CacheInvalidate Magento_Captcha Magento_CatalogRuleConfigurable Magento_CatalogWidget Magento_CheckoutAgreements Magento_ConfigurableImportExport Magento_ConfigurableProduct Magento_Cookie Magento_CurrencySymbol Magento_CustomerImportExport Magento_Deploy Magento_Dhl Magento_DownloadableImportExport Magento_EncryptionKey Magento_Fedex Magento_GoogleAdwords Magento_GoogleAnalytics Magento_GoogleOptimizer Magento_GroupedImportExport Magento_LayeredNavigation Magento_Marketplace Magento_Multishipping 
Magento_NewRelicReporting Magento_OfflinePayments Magento_OfflineShipping Magento_Paypal Magento_Persistent Magento_ProductVideo Magento_SalesInventory Magento_SendFriend Magento_Sitemap Magento_Swagger Magento_Swatches Magento_SwatchesLayeredNavigation Magento_TaxImportExport Magento_Ups Magento_Usps Magento_Vault Magento_Version Magento_Webapi Magento_WebapiSecurity Magento_Weee
```

Reference https://www.integer-net.com/why-and-how-to-disable-magento-2-core-modules-improve-performance/

---
# Disable GraphQl modules
```bash
bin/magento module:disable `bin/magento module:status | grep -i graphql`
```

---
# Replacing it with nothing
File `composer.json`:
```json
{
    ...
    "replace": {
        "magento/module-marketplace": "*"
    },
    ...
}
```

---
# Common things to replace
File `composer.json`:
```json
"replace": {
        "amzn/amazon-pay-and-login-magento-2-module": "*",
        "amzn/amazon-pay-and-login-with-amazon-core-module": "*",
        "amzn/amazon-pay-module": "*",
        "amzn/amazon-pay-sdk-php": "*",
        "amzn/login-with-amazon-module": "*",
        "astock/stock-api-libphp": "*",
        "braintree/braintree": "*",
        "braintree/braintree_php": "*",
        "dotmailer/dotmailer-magento2-extension": "*",
        "dotmailer/dotmailer-magento2-extension-chat": "*",
        "dotmailer/dotmailer-magento2-extension-enterprise": "*",
        "dotmailer/dotmailer-magento2-extension-package": "*",
        ...
```

---
# What don't you need
- Core extensions if you don't use them
- Bundled extensions if you don't use them
- GraphQL if you don't have a PWA shop
- MSI if you want to use the legacy
- ...

---
# Yireo composer packages
```bash
composer require yireo/magento2-replace-bundled
composer require yireo/magento2-replace-content-staging
composer require yireo/magento2-replace-core
composer require yireo/magento2-replace-graphql
composer require yireo/magento2-replace-inventory
composer require yireo/magento2-replace-sample-data
composer require yireo/magento2-replace-all
```

Don't just use all of this, especially `yireo/magento2-replace-all`

See https://github.com/yireo/magento2-replace-tools

---
# Todo
- Replace ElasticSearch as well (with nothing)
- Feel free to add more ideas as **Issues** on GitHub

---
{state: main middle}
{background-image: mageid/luma-blurred.png}
# Removing other stuff

---
# Removing other stuff
Regular HTML source
```html
<link  rel="stylesheet" type="text/css"  media="all" href="http://localhost/static/frontend/Yireo/ExampleTheme/en_US/mage/calendar.css" />
```

---
# Removing other stuff
Regular HTML source:
```html
<link  rel="stylesheet" type="text/css"  media="all" href="http://localhost/static/frontend/Yireo/ExampleTheme/en_US/mage/calendar.css" />
```

XML layout:
```xml
<?xml version="1.0"?>
<page layout="1column" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <update handle="default_head_blocks" />
    <head>
        <remove src='mage/calendar.css'/>
    </head>
</page>
```

---
# Removing more
XML layout:
```xml
<?xml version="1.0"?>
<page layout="1column" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <update handle="default_head_blocks" />
    <head>
        <remove src='mage/calendar.css'/>
        <remove src='mage/gallery/gallery.css'/>
    </head>

    <body>
        <referenceBlock name="yotpo_widget_script" remove="true" />
    </body>
</page>
```

---
# Replacing unneeded JavaScript
```js
var config = {
    paths: {
        'mage/calendar': 'js/zero',
        'Magento_Ui/js/grid/filters/range': 'js/zero',
        'mage/polyfill': 'js/zero',
        'mage/translate-inline': 'js/zero',
        'Magento_Captcha/js/model/captcha': 'js/zero',
    }
};
```

---
# Todo
~ Upgrades of jQuery, Knockout, RequireJS
~ Replace CSS/JS default menu with simple CSS-only menu
~ Replace JS-driven breadcrumbs with plain HTML-only
~ See https://github.com/yireo-training/Yireo_OptimizedTheme
    - But do NOT apply it. Use its ideas, not its source.

---
# Downsizing images
~ Yireo_Webp2
    - Converting JPG & PNG into WebP
    - 10-30% reduction in size
    - https://github.com/yireo/Yireo_Webp2
~ Coming up: Yireo_NextGenImages
    - Support for Webp, AVIF, JPEG2000, ...
    - 10-60% reduction in size

---
# Reacticon v3.1
~ Purely focused on frontend development
    - Especially headless & PWA
~ October 13th-15th
    - October 13th: Vue
    - October 14th: React
    - October 15th: Other stuff
~ Free attendance, live-streamed to YouTube
~ Join now via Slack because devs love Slack
~ https://reacticon.org/

---
{state: main middle dark}
{background-image: mageid/orangutan.jpg}
# The Magento frontend sucks
## But you can make it suck less

---
{state: main middle dark}
{background-image: mageid/offering.jpg}
# Don't just use what Magento offers you
## Customize it, so it fits your needs

---
{state: main middle dark}
{background-image: mageid/clogs.jpg}
# Thanks
## @jissereitsma / @yireo
