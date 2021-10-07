{state: main middle dark}
{background-image: apollo/bg-startrek.png}
# Optimizing Luma legacy anyway

---
{state: main middle dark}
# Luma dissected

---
# Luma stack (server-based)
- XML layout
- Block classes
- ViewModel classes
- PHTML templates

---
# Quick tips for development
- Enable all caching
  - Except Full Page Cache
  - Use Mage2TV Cache Cleaner
- Use XDebug only On-Demand
- Enable Zend OPC
- Use Redis for caching
- Test for Full Page Cache
  - Beware of `cacheable=true`

---
# Quick tips for production
- Enable all caching
  - Including Full Page Cache
- Disable XDebug
- Enable Zend OPC
- Use Redis for caching
- Tune MySQL
- Compress everything
- Downsize images
- Serve fonts locally

---
# Luma stack (client-based)
- RequireJS
- KnockoutJS
- jQuery
- LESS-based CSS

So how does this perform?

---
# Core Web Vitals
- First Input Delay (FID)
  - Measures interactivity
  - Within 100 milliseconds
- Largest Contentful Paint (LCP)
  - Measures loading performance
  - Within 2.5 seconds
- Cumulative Layout Shift (CLS)
  - Measures visual stability
  - 0.1 or less

---
# Reporting tools
- Google Lighthouse
- Google PageSpeed Insights
- GTmetrix
- Pingdom
- Web Page Test

---
# The problem of RequireJS
- Async loading
  - Waterfall mess
- Too many resources
  - And you benefit less/little from HTTP2

And it is old

---
# The problem of KnockoutJS
- Lazyloaded via RequireJS
- No VirtualDOM
- Magento made a mess of it

And it is old

---
# The problem of jQuery
- jQuery 3 is not supported (yet)
  - So we are using jQuery 1 which is larger
- jQuery UI modularization is not supported by all extensions
  - So we are using jQuery UI in full which is huge

And it is old

---
# jQuery UI modularization
Bad:
```js
define([
    'jquery',
    'jquery/ui'
], function() { ... });
```

Good:
```js
define([
    'jquery',
    'jquery-ui-modules/datepicker'
], function() { ... });
```

See `lib/web/jquery/compat.js`

---
# The problem of LESS/CSS
- Weird responsiveness with recursive loop
- Badly organized
- Too many files

And LESS is old

---
# Let's fix this

---
# My own experimental optimizations
- [yireo-training/Yireo_OptimizedTheme](https://github.com/yireo-training/Yireo_OptimizedTheme)
  - Removing unneeded things like `calendar.css` and others
  - Knockout replacements
- [yireo-training/magento2-example-jquery-upgrade](https://github.com/yireo-training/magento2-example-jquery-upgrade)
  - Upgrade jQuery 1 to jQuery 3

Note that this is all experimental

---
# Remove silly CSS
Layout file `default.xml`:
```xml
<?xml version="1.0"?>
<page layout="1column" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <update handle="default_head_blocks" />
    <head>
        <remove src='mage/calendar.css'/>
        <remove src='mage/gallery/gallery.css'/>
    </head>
</page>
```

---
# RequireJS replacements
File `requirejs-config.js`
```js
var config = {
    paths: {
        //'knockoutjs/knockout-fast-foreach': 'js/zero',
        //'knockoutjs/knockout-es5': 'js/zero',
        'mage/calendar': 'js/zero',
        'Magento_Ui/js/grid/filters/range': 'js/zero',
        'mage/polyfill': 'js/zero',
        //'mage/menu': 'js/zero',
        'mage/translate-inline': 'js/zero',
        'Magento_Captcha/js/model/captcha': 'js/zero',
        //'jquery/jquery-migrate': 'js/zero',
        //'Magento_Ui/js/lib/logger/logger': 'js/zero',
        //'Magento_Ui/js/lib/logger/formatter': 'js/zero',
        //'Magento_Ui/js/lib/logger/console-logger': 'js/zero',
    }
};
```

---
# Todo
~ Upgrades of jQuery, Knockout, RequireJS
    - Currently adding in size, not reducing it
~ Replace CSS/JS default menu with simple CSS-only menu
    - We don't need JS for this anymore. But I'm not a CSS expert.
~ Replace JS-driven breadcrumbs with plain HTML-only
    - Who cares about the JS logic here?
~ See https://github.com/yireo-training/Yireo_OptimizedTheme
    - Removing various scripts that appear not to be needed.
    - But do NOT apply it. Use its ideas, not its source.
~ See https://github.com/yireo/Yireo_FasterScriptLoader
    - Replacing all `data-mage-init` and `x-magento-init` with `require()`
    - Do NOT use it. This is not adding any benefits yet.
~ Compare all of this with new frontends
    - Vue Storefront
    - Magento PWA Studio
    - Hyvä (hyva.io)

---
# Proven optimizations
- Bundle JS with Magepack
- Replace Fotorama (with Notorama)
- Add Webp2 images
- Hack with SwissupLabs Breeze
- Enable Full Page Cache with or without Varnish

^^And backend optizations like composer replacements, database tuning, external search engines, etc

---
# Magepack
```bash
composer require creativestyle/magesuite-magepack
bin/magento module:enable MageSuite_Magepack
bin/magento setup:upgrade
bin/magento config:set dev/js/enable_magepack_js_bundling 1
```

```bash
npm install -g magepack
magepack generate --cms-url="http://magento.local" --category-url="http://magento.local/women/" --product-url="http://magento.local/training/hyva"
magepack bundle
```

^^Refer to [github](https://github.com/magesuite/magepack)

---
# Webp2
```bash
composer require yireo/magento2-webp2
bin/magento module:enable Yireo_Webp2 Yireo_NextGenImages
bin/magento setup:upgrade
bin/magento config:set yireo_webp2/settings/enabled 1
```

---
# SwissupLabs Breeze setup
Run the following commands
```bash
composer require swissup/module-marketplace
bin/magento setup:upgrade
bin/magento marketplace:channel:enable swissuplabs
composer require swissup/breeze
bin/magento module:enable Swissup_Breeze
```

Next, navigate to your theme configuration and enable Breeze

???
```json
{
    "http-basic": {
        "ci.swissuplabs.com": {
            "username": "m2.sirius.yr",
            "password": "c3dpc3N1cGxhYnMuY29t:cZiJMmnGAGIoIg/R9hvcqzmpmVGJ3aRw:"
        }
    }
}
```

---
# Breeze features
- Removing pointless CSS
  - `mage/calendar.css`
  - `mage/gallery/gallery.css`
- Replaces numerous Magento JS core scripts
  - Updates of numerous 3rd party libraries
  - Better product gallery
  - Better swatch renderer
  - See `view/frontend/layout/breeze_default.xml`
- Addition of [turbolinks](https://github.com/turbolinks/turbolinks)
- Also see [devdocs](https://docs.swissuplabs.com/m2/extensions/breeze/devdocs/)

^^But: For this to work, your own JS needs to be converted to the Breeze structure ([docs](https://docs.swissuplabs.com/m2/extensions/breeze/devdocs/theme-js/))
