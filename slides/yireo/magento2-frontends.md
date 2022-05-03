{state: main middle}
# Magento 2 Frontends
# in 2022


---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Member of ExtDN
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2, 2020, 2021)
~ Magento Master 2017/2018/2019 Mover
~ Trainer of backend and frontend developers

---
# My Magento story
- Built first shop with Magento 1.0
- Build first shop with Magento 1.1
- Became a Magento extension provider
- Became a Magento trainer
- Became disappointed with Magento Luma in 2015

---
# Magento 2 frontends in 2022
- Magento Blank & Magento Luma
- Snowdog SASS
- Snowdog Alpaca
- Vue Storefront 1 or 2
- Magento / Adobe PWA Studio
- GraphCommerce
- Hyvä
- ...

---
{state: main middle}
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
{state: main middle}
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

---
# Full Page Cache
```bash
bin/magento cache:enable full_page
```

^^Remove any third party extension that disallows you to use the Full Page Cache (like setting `cacheable="false"`)

---
# Varnish
- Frontend proxy for large traffic
- Varnish Cache vs Varnish Plus
- Varnish 3
    - No SSL support
- Varnish 4, 5 or higher
    - SSL support via SSL termination
    - SSL terminators: Hitch, Pound, HAProxy, Nginx, Apache
- Other addons
    - `vmod` modules like Saint Mode

---
# Varnish in Magento
- VCL configuration file
    + Generated via Magento Store Configuration
    + *Advanced > System > Full Page Cache*

---
{state: main middle}
# This is all trying to fix something that is broken from the start

---
{state: main middle}
# Luma hasn't been modernized in 6 years time

---
{state: main middle}
# AMP vs PWA vs SPA

---
# Actual meanings
- AMP: Accelerated Mobile Pages
    - Subset of HTML and JS offered and working through Google Search (kind of)
- PWA: Progressive Web Apps
    - Adding progressively (mobile) features to make site behave like app
- SPA: Single Page Application
    - Load simple HTML skeleton, then build DOM using JS
    - Commonly built with React and Vue

^^And **Something, something, headless**

---
# So what is PWA? (features)
- Offline behaviour
    - Requires a service worker
- Push notifications
    - Requires a service worker
- Add to dashboard
    - Requires a `manifest.json`
- Splash screen
    - Requires a `manifest.json`
- ...

^^Theoretically any browser feature (which requires some JS API to be useful) could be labeled as a PWA feature

---
# So what is PWA? (technologies)
- Service worker (`sw.js`)
- Manifest file (`manifest.json`)
- In case of an SPA
    - HTML skeleton / application shell
    - JavaScript (React, Vue, ...)
    - API calls (REST, GraphQL)

---
# Adding PWA to Magento
- [monsoonconsulting/magento2-pwa](https://github.com/monsoonconsulting/magento2-pwa)
- ...

^^Or build an SPA with React or Vue

---
{state: main middle}
# Magento PWA Studio

---
{state: main middle}
# ~~Magento PWA Studio~~
# Adobe PWA Studio

---
# Adobe PWA Studio
- React components and hooks
    - Venia theme
    - Peregrine hooks (talons)
- Webpack environment
    - Buildpack with Google Workbox
    - UPWARD proxy
- GraphQL API
    - Included with Magento 2.3+
    - React uses Apollo Client to connect

---
# Getting started with React
Create React App:
```bash
npx create-react-app my-app
cd my-app
yarn start
```

---
# PWA Studio quick start
PWA setup:
```bash
yarn create @magento/pwa
yarn watch
```

---
{state: main middle}
# Quick GraphQL rundown

---
# Main PWA Studio pilars
- Venia Concept theme
- Venia UI component library
- Peregrine hook library
- Buildpack
- Interception API
- UPWARD for SSR

---
# Extending Venia
- Tree replacement
- Webpack-based replacements
- Targetables

---
# Tree replacement
- Let's add `Example` to `Main`
- Override `Main`
- Override `App`
- Override `index.js`

---
# Webpack-based replacements
- Foomans Override Resolver
- Lars Roettig his method
- Custom Webpack solution
- ...

---
# Target interception
- Trick in Webpack
- Features
  - Create routes
  - Offer rich content renderers (for PageBuilder)
  - Wrapping talons
- Targetables

---
# Example
```js
const { Targetables } = require('@magento/pwa-buildpack')
module.exports = targets => {
  const targetables = Targetables.using(targets);
  const Header = targetables.reactComponent(
          '@magento/venia-ui/lib/components/Header/header.js'
  );
  Header.insertAfterJSX('<MegaMenu />', '<div>Foobar</div>')
}
```

---
# Key take-aways
- Venia is a Concept Theme, not a parent theme
- Target Interception allows for extensibility but makes things complex as well
- UPWARD will be phased out, React SSR will be used instead
- Why use 

---
{state: main middle}
# Vue Storefront 2

---
# Vue Storefront 2
- Vue 2
- NuxtJS
- Modular architecture
    - Shopify
- Or other bakend systems
    - CMS, ElasticSearch, ERPs, etc

^^Vue Storefront 2 connector for Magento 2 is almost done

---
# Key concept
- Vue components with composables
- Vue composable state
- Apollo Client for GraphQL calls

---
{state: main middle}
# Headless?

---
# The definition of headless
- Separating backend from frontend
    - Different teams, same project
- Other buzzwords
    - Microservices, microfrontends, composable commerce

---
{state: main middle}
# Hyvä

---
# Hyvä
- Same backend stack as Luma
    - XML layout, Blocks, ViewModels, PHTML
- Different frontend stack
    - Tailwind CSS, AlpineJS

^^Why? Check the speed (but not just via Lightspeed)

---
# Tailwind & Alpine in Hyvä
- PHTML templates
    - Tailwind CSS classes in HTML
- CSS builds
    - Tailwind dev build vs prod build (+ purging)
- Tailwind JIT
    - CMS support including PageBuilder
- Minimal JS usage
    - Only for dynamic effects or private content
- Checkout
    - Eiter original Luma or React-based or ...?

---
# Challenges with Hyvä
- Growing community
    - Learn Tailwind/Alpine/Magento first, then call for help
- Support for third party extensions
    - Compatibility matrix, compatibility modules
- Checkout options are in progress
    - Regular checkout is supported
    - React Checkout has just reached alpha-state

---
# Converting extensions
- Create a compatibility module
    - Like `Hyva_YireoOld`
    - Automatically override all PHTML templates
- Rewrite all code
    - Tailwind, Alpine, custom logic

---
{state: main middle}
# Summary

---
# Yireo promo
- All extensions are free, except one: EmailTester2
- On-site training
    - Magento 2, Shopware 6, Vue, Vue Storefront 2, React, GraphQL
- On-Demand courses
    - Vue Storefront 1
    - Magento PWA Studio
    - Magento Backend Development
    - Magento Luma Development
    - Magento Hyvä Development
    - Shopware PWA (summer 2022)
    - Magento Backend Development (summer 2022)

---
# Magento 2 frontending in 2022
- Don't refer to Luma as **THE** Magento 2 frontend anymore
- Hyvä is a fierce competitor
    - For Magento developers
- Adobe PWA Studio is a fierce competitor
    - For React developers
- Vue Storefront 2 is a fierce competitor
    - For Vue developers

---
# Magento 2 backending in 2022
- Magento 2.5 would bring more Service Oriented Architecture
    - gRPC, isolated services, composable commerce
- Adobe will downsize Magento (according to Jisse)
    - E-commerce is meant for Adobe Experience Cloud
    - More cloud features will become open-source features (like PageBuilder)
    - Magento Association should become more prominent

---
{state: main middle}
# Questions
