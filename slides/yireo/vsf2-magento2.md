{state: main middle dark}
# Getting started
# with Vue Storefront 2
# for Magento 2

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of backend and frontend developers
- Magento, React, PWA Studio, Shopware 6, Vue Storefront, GraphQL
  ~ Creator of MageTestFest (2017, 2019)
  ~ Creator of Reacticon (2018 x2)
  ~ Creator of Reacticon v3 (October 2020)
  ~ Creator of Reacticon v4 (October 2021)
  ~ Magento Master 2017/2018/2019 Mover
  ~ Member of ExtDN (Magento Extension Developer Network)

---
# Vue Storefront 2 is green

@todo
[ukraine flag] = [green logo]

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
- Legacy code

---
# Vue Storefront 2
- Based on NuxtJS
- Depending on Vue composables
- Fresh start

---
# Concepts
- Build your own, instead of inheriting legacy
- Composition over inheritance
- Composables over parent/child theming

---
# Current status of M2 integration
- Beta and not ready for production usage
- Most product types supported
  - Simple, Grouped, Configurable, Bundled = ok
  - Virtual, Downloadable = partial
- CMS Pages & Blocks supported, but not PageBuilder
- Minicart working, no standalone cart page yet
- Customer account features still in progress

^^See https://docs.vuestorefront.io/magento/guide/functional-catalog.html

---
# Kudos

Thanks to all contributors making Vue Storefront and more specifically Vue Storefront 2 for Magento 2 possible

- Cyberfuze
- Leonex
- Caravelx
- And many individual developers

# Installing Vue Storefront 2 for Magento 2

---
# Requirements
- Node 16
- Magento 2.4.3
  - Changed query complexity and query depth

^^Use [Caravel_GraphQlConfig](https://github.com/caravelx/module-graphql-config) or [Yireo_CustomGraphQlQueryLimiter](https://github.com/yireo/Yireo_CustomGraphQlQueryLimiter)

---
# Installation
```bash
npm i -g @vue-storefront/cli
```
And then run:
```bash
vsf init magento2-demo
```

^^In the wizard, choose `Magento 2`

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
MAGENTO_EXTERNAL_CHECKOUT=false
MAGENTO_EXTERNAL_CHECKOUT_URL=http://magento.local/checkout
MAGENTO_EXTERNAL_CHECKOUT_SYNC_PATH=/vue/cart/sync
MAGENTO_BASE_URL=http://magento.local/
IMAGE_PROVIDER=ipx
IMAGE_PROVIDER_BASE_URL=
```

---
# Or
File `.env`:
```env
STORE_ENV=dev
```

^^Variable `STORE_ENV` points to `dev`, which leads to configuration file `config/dev.json`


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
# Other topics
- SSR and server-side optimization
- Image providers
- Languages & internationalization
- GraphQL customization
- Performance


---
{state: main middle dark}
{background-image: mageid/clogs.jpg}
# Thanks
## @jissereitsma / @yireo
