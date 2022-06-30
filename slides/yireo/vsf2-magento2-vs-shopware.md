{state: main middle dark}
{background-image: vsf2/vsf2-logo.webp}
# Getting started
# with Vue Storefront 2
# for Magento 2

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2, 2020, 2021)
~ Magento Master 2017/2018/2019 Mover
~ Trainer of backend and frontend developers

---
# Yireo On-Demand courses
- Magento 2 Luma Frontend Development
- Magento 2 Luma JavaScript Development
- Magento 2 Backend Development I
- Vue Storefront 1
- Shopware PWA

---
{state: main middle dark}
{background-image: vsf2/vsf2bus.jpg}
# Vue Storefront 2 is green

---
# My Vue Storefront story
- First meet with Filip at Reacticon 1
- Vue Storefront 1 live training
- VSF1 consults and coding experiments
- Visits in Wrocław, Poland
- Vue Storefront 1 on-demand training
- Shopware PWA on-demand training (Q2)
- Vue Storefront 2 on-demand training (Q?)

---
# Vue Storefront 1
- Tight integration with Magento 1 & Magento 2
- Requirement for Node middleware
- Tough customization and SSR
- Legacy code

---
# Vue Storefront 2
- Based on NuxtJS
- Requirement for Node middleware
- Depending on Vue composables
- Fresh start

---
# Concepts of component architecture
- Build your own, instead of inheriting legacy
- Composition over inheritance
- Composables over parent/child theming

---
# Current status of Magento 2 integration
- Beta and not ready for production usage
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
{state: main middle}
# Installing Vue Storefront 2
# for Magento 2

---
# Requirements
- Node 16
- Magento 2.4.3
  - GraphQL API enabled
    - Don't use [yireo/magento2-replace-graphql](https://github.com/yireo/magento2-replace-graphql)
  - Change query complexity and query depth
    - Use [Caravel_GraphQlConfig](https://github.com/caravelx/module-graphql-config)
    - Or [Yireo_CustomGraphQlQueryLimiter](https://github.com/yireo/Yireo_CustomGraphQlQueryLimiter)

---
# Development tools
- Vue Devtools
- VSCode or some other editor
- GraphiQL tool like ChromeiQL or Altair

---
# Installation
```bash
npm i -g @vue-storefront/cli
```
And then run:
```bash
vsf init magento2-demo
```

In the wizard, choose `Magento 2`

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
NUXT_APP_ENV=development
NUXT_APP_PORT=3000

MAGENTO_GRAPHQL=http://magento.local/graphql
MAGENTO_BASE_URL=http://magento.local/
MAGENTO_EXTERNAL_CHECKOUT=false
MAGENTO_EXTERNAL_CHECKOUT_URL=http://magento.local/checkout
MAGENTO_EXTERNAL_CHECKOUT_SYNC_PATH=/vue/cart/sync

IMAGE_PROVIDER=ipx
IMAGE_PROVIDER_BASE_URL=
```

---
# Or
File `.env`:
```env
STORE_ENV=dev
```

Variable `STORE_ENV` points to `dev`, which leads to configuration file `config/dev.json`


---
# Configuration file
File `config/dev.json`
```json
{
  "magentoGraphQl": "http://magento.local/graphql",
  "enableMagentoExternalCheckout": false,
  "externalCheckoutUrl": "http://magento.local/checkout",
  "externalCheckoutSyncPath": "/vue/cart/sync",
  "nuxtAppEnvironment": "development",
  "nuxtAppPort": 3000,
  "imageProvider": "ipx",
  "magentoBaseUrl": "http://magento.local/",
  "imageProviderBaseUrl": ""
}
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
{state: main middle dark}
{background-image: mageid/clogs.jpg}
# Thanks
# @jissereitsma / @yireo
