{state: main middle dark}
{background-image: apollo/bg-startrek.png}
# Optimizing Luma legacy anyway

---
# Optimizations

---
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

---
# Caching architecture
- Caching frontends
  - Tags, types
- Caching backends
  - Filesystem, database, Redis, memcached
- Reverse proxies / CDNs
  - Full Page Cache via Varnish

^^Beware of `cacheable=true`

---
# Luma stack (client-based)
- RequireJS
- KnockoutJS
- jQuery
- LESS-based CSS

^^So how does this perform?

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

^^And it is old

---
# The problem of KnockoutJS
- Lazyloaded via RequireJS
- No VirtualDOM
- Magento made a mess of it

^^And it is old
---
# The problem of jQuery
- jQuery 3 is not supported (yet)
  - So we are using jQuery 1 which is larger
- jQuery UI modularization is not supported by all extensions
  - So we are using jQuery UI in full which is huge

^^And it is old

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

^^See `lib/web/jquery/compat.js`

---
# The problem of LESS/CSS
- Weird responsiveness with recursive loop
- Badly organized
- Too many files

^^And LESS is old

---
# Let's fix this

---
# Basic optimization
- Enable caching
- Run Production Mode
- Use up-to-date PHP
- Enable Zend OPC, disable Xdebug
- Tune MySQL
- Compress everything
- Downsize images
- Serve fonts locally

---
# My own experimental optimizations
- [yireo-training/Yireo_OptimizedTheme](https://github.com/yireo-training/Yireo_OptimizedTheme)
  - Removing unneeded things like `calendar.css` and others
  - Knockout replacements
- [yireo-training/magento2-example-jquery-upgrade](https://github.com/yireo-training/magento2-example-jquery-upgrade)
  - Upgrade jQuery 1 to jQuery 3

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