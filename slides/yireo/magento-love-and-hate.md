{state: main middle dark}
{background-image: magento-love-and-hate/thor.jpg}
# Magento
# Love and Hate

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Man of Yireo
~ Trainer of backend and frontend developers
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2, 2020, 2021)
~ Creator of MageUnconference NL (2023, 2025)
~ Magento Master 2017/2018/2019 Mover
~ Board member of Mage-OS Nederland

---
{state: main middle dark}
{background-image: vsf2/vsf2bus.jpg}
# Magento: Love and hate

---
# Magento?
~ Magento Open Source?
~ Adobe Commerce?
~ Mage-OS?

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
