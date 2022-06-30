{state: main middle dark}
{background-image: vsf2/vsf2-logo.webp}
# Vue Storefront 2
# Magento 2 versus Shopware 6

---
{state: speaker}
{background-image: generic/jisse.jpg}

# Jisse Reitsma
~ Founder of Yireo (training, extensions, blog)
~ Creator of 2x MageTestFest (2017, 2019)
~ Creator of 4x Reacticon (2018, 2018, 2020, 2021)
~ 3x Magento Master 2017/2018/2019 Mover
~ Board member of ExtDN
~ Trainer of backend and frontend developers

---
# Yireo On-Demand courses
~ Magento 2 Luma Frontend Development (12h)
~ Magento 2 Luma JavaScript Development (14h)
~ Magento 2 Hyva Development (10h)
~ Magento 2 Backend Development I (16h)
~ Adobe PWA Studio Development (12h)
~ Vue Storefront 1 for Magento 1 and 2 (9h)
~ Free Shopware videos for developers (24h)
~ Shopware PWA (5h)

---
# Upcoming On-Demand courses in 2022
- Free Shopware App videos via Shopware (6h+)
- Magento 2 Backend Development II (12h+)
- Magento 2 Backend Development III (12h+)
- Vue Storefront 2 for Magento 2?

---
{state: main middle dark}
{background-image: vsf2/vsf2bus.jpg}
# Vue Storefront 2 is green

---
# My Vue Storefront story
- First meet with Filip at Reacticon 1 (2018)
- Vue Storefront 1 live training (2019)
- VSF1 consults and coding experiments (2019)
- Visits in Wrocław, Poland (Q1 2020)
- Vue Storefront 1 on-demand training (Q4 2020)
- Shopware PWA on-demand training (Q2 2022)
- Vue Storefront 2 on-demand training (?)

---
# Vue Storefront 1 for Magento
- Tight integration with Magento 1 & Magento 2
- Requirement for Node middleware
- Tough customization and SSR
- Legacy code

---
# Vue Storefront 2 for ...
- Based on NuxtJS
- Requirement for Node middleware
- Depending on Vue composables
- Fresh start

---
# Integrations
- Shopware
- CommerceTools
- Shopify
- Elastic Path
- BigCommerce
- Magento 2

---
# Lessons learned of VSF1
- Don't build SSR yourself
  - Nuxt
- Create a clean UI component library
  - Storefront UI
- Write modular code only
  - Plugins, modules, middleware, ...
- Separate components from logic
  - A new component architecture

---
# Concepts of component architecture
- Build your own, instead of inheriting legacy
- Composition over inheritance
- Composables over parent/child theming

---
{state: main middle}
# Magento 2 vs Shopware 6

---
# Shopware PWA
- Shopware 6 Store API (and Admin API)
- Composables for state management

---
# Current milestones (June 2022)
- Nuxt 3 RC4
- Shopware PWA v1.5.0
- Vue 2 EOL in 2023

---
# Current status of Shopware 6 integration
- Most product features are supported
  - Products, properties, custom fields, ...
- CMS is fully supported
- Functional cart and checkout
- Some less used features still in progress

^^See https://shopware-pwa-docs.vuestorefront.io/landing/resources/roadmap.html

---
# Repositories
- [vuestorefront/shopware-pwa](https://github.com/vuestorefront/shopware-pwa)
- ~~[vuestorefront/vue-storefront](https://github.com/vuestorefront/vue-storefront)~~

^^See Shopware PWA as a clone of the original Vue Storefront

---
{state: main middle}
# Installing Shopware PWA

---
# Requirements
- Node 16+
- Shopware 6.4
  - `SwagShopwarePwa` plugin

^^Check supported versions on https://github.com/vuestorefront/shopware-pwa

---
# Installation
```bash
npx @shopware-pwa/cli init
```

---
# Up and running
```bash
cd sw6pwa
yarn dev
```

---
# PWA configuration
File `shopware-pwa.config.js`:
```js
module.exports = {
  shopwareEndpoint: "https://shopware6-demo.vuestorefront.io",
  shopwareAccessToken: "SWSCVJJET0RQAXFNBMTDZTV1OQ"
};
```

---
{state: main middle}
# Customization of code

---
# Customization of code
- Overriding pages
- Overriding components
- Overriding CSS
- Overriding composables
- Overriding GraphQL queries & mutations

All with as little core hacks as possible

---
# Overriding components
- Regular components, pages, layouts, views, ...
- Run `yarn shopware-pwa override`
- Or copy manually from `.shopware/source/` into `src/`

---
# Wrapping component (the Jisse way)
File `src/components/SwFooter.vue`:
```vue
<template>
    <OriginalSwFooter columns="3" />
</template>

<script>
import OriginalSwFooter from '@theme/components/SwFooter.vue';

export default {
    name: "NewSwFooter",
    components: {
        OriginalSwFooter
    }
}
</script>
```

---
# Overriding Storefront UI components
- Override via Webpack ...

```js
export default {
  build: {
    extend(config) {
      config.resolve.plugins = [
        new Vsf2ThemeInheritancePlugin({
          originalPath: path.resolve(__dirname, 'components'),
          newPath: path.resolve(__dirname, 'custom-components')
        })
      ]
    }
  }
}
```

See https://github.com/yireo/vsf2-webpack-inheritance-plugin

---
# Overriding composables
- Don't override composables
- Compose your own composables out of existing composables instead

---
# Overriding API calls
- Create folder `queries/` (or simialar)
- Copy file from `api-client/` to `queries/` (for example `productList.ts`)

---
# Registering the custom query file
File `middleware.config.js`:
```js
import productsQuery from './queries/productList';

module.exports = {
  integrations: {
    magento: {
      productsQuery: {
        products: ({ query, variables }) => {
          return { query: productsQuery, variables };
        },
      },
      ...
    },
  },
};
```

---
# More customization
- Custom Vue / Nuxt / VSF2 composables
- Nuxt plugins, Nuxt middleware, Vue plugins
- Webpack alias, Webpack plugins
- Image providers
- And modifying the GraphQL API in Magento 2

---
# Remember the concepts
- Build your own, instead of inheriting legacy
- Composition over inheritance
- Composables over parent/child theming

???????????????????????????????????????????????????????

---
# Vue Storefront 2 for Magento 2
- Magento 2 GraphQL API
- Pinia for state management

---
# Current milestones (June 2022)
- Nuxt 3 RC4
- VSF2 for M2 RC9
- Vue 2 EOL in 2023

---
# Current status of Magento 2 integration
- Most product types supported
  - Simple, Grouped, Configurable, Bundled = ok
  - Virtual, Downloadable = partial
- CMS Pages & Blocks supported, but not PageBuilder
- Minicart working, no standalone cart page yet
- Customer account features still in progress

See https://docs.vuestorefront.io/magento/guide/functional-catalog.html

---
# Kudos

Thanks to all contributors making Vue Storefront and more specifically Vue Storefront 2 for Magento 2 possible

- Cyberfuze
- Leonex
- Caravelx
- And many individual developers

---
# Repositories
- [vuestorefront/magento2](https://github.com/vuestorefront/magento2) (`@vue-storefront/magento`)
- [vuestorefront/vue-storefront](https://github.com/vuestorefront/vue-storefront)

^^Do not use [vuestorefront/mage2vuestorefront](https://github.com/vuestorefront/mage2vuestorefront) which belongs to VSF1

---
{state: main middle}
# Installing Vue Storefront 2
# for Magento 2

---
# Requirements
- Node 16+
- Magento 2.4.3
  - Changed query complexity and query depth
  - Served via HTTPS

^^Use [Caravel_GraphQlConfig](https://github.com/caravelx/module-graphql-config) or [Yireo_CustomGraphQlQueryLimiter](https://github.com/yireo/Yireo_CustomGraphQlQueryLimiter) to set complexity to 1500 and depth to 20

---
# Installation
```bash
npm i -g @vue-storefront/cli
```
And then run:
```bash
cli generate store
```

^^In the wizard, choose a name and select `Magento 2`

---
# Up and running
```bash
cd magento2-demo/
yarn install
```
And once it finishes:
```bash
yarn dev
```

---
# Environment settings
File `.env`:
```env
VSF_NUXT_APP_ENV=development
VSF_NUXT_APP_PORT=3000

VSF_MAGENTO_BASE_URL=http://magento.local/
VSF_MAGENTO_GRAPHQL_URL=http://magento.local/graphql
VSF_MAGENTO_EXTERNAL_CHECKOUT=false
VSF_MAGENTO_EXTERNAL_CHECKOUT_URL=http://magento.local/checkout
VSF_MAGENTO_EXTERNAL_CHECKOUT_SYNC_PATH=/vue/cart/sync

VSF_IMAGE_PROVIDER=ipx
VSF_IMAGE_PROVIDER_BASE_URL=
```

---
# Using self-signed certificates
Add to `.env`:
```init
NODE_TLS_REJECT_UNAUTHORIZED=0
```

- Or theoretically add your certificate file to `NODE_EXTRA_CA_CERTS`
- Or use LetsEncrypt

---
{state: main middle}
# Customization of code

---
# Customization of code
- Overriding pages
- Overriding components
- Overriding CSS
- Overriding composables
- Overriding GraphQL queries & mutations

All with as little core hacks as possible

---
# Overriding pages
- Modify `routes.js`
- Or customize the original `pages/*`
- Or create a Nuxt middleware to extend router

---
# Overriding layouts
- Modify `routes.js` to refer to a new layout
- Or customize the original `layouts/*`
- Or create a Nuxt middleware to extend router

---
# Overriding CSS
- Just edit the `assets/styles.scss` file. It is empty.

---
# Overriding components
- Customize the original `components/*`
- Or override via Webpack ...

```js
export default {
  build: {
    extend(config) {
      config.resolve.plugins = [
        new Vsf2ThemeInheritancePlugin({
          originalPath: path.resolve(__dirname, 'components'),
          newPath: path.resolve(__dirname, 'custom-components')
        })
      ]
    }
  }
}
```

See https://github.com/yireo/vsf2-webpack-inheritance-plugin

---
# Overriding composables
- Don't override composables
- Compose your own composables out of existing composables instead

---
# Overriding GraphQL queries
- Create folder `queries/` (or simialar)
- Copy file from `api-client/` to `queries/` (for example `productList.ts`)

---
# Registering the custom query file
File `middleware.config.js`:
```js
import productsQuery from './queries/productList';

module.exports = {
  integrations: {
    magento: {
      productsQuery: {
        products: ({ query, variables }) => {
          return { query: productsQuery, variables };
        },
      },
      ...
    },
  },
};
```

---
# More customization
- Custom Vue / Nuxt / VSF2 composables
- Nuxt plugins, Nuxt middleware, Vue plugins
- Webpack alias, Webpack plugins
- Image providers
- And modifying the GraphQL API in Magento 2

---
# Remember the concepts
- Build your own, instead of inheriting legacy
- Composition over inheritance
- Composables over parent/child theming

---
# Ready or not?

---
{state: main middle dark}
{background-image: mageid/clogs.jpg}
# Thanks
# @jissereitsma / @yireo
