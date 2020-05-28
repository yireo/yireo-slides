{state: main middle dark}
{background-image: heman/heman-rainbow.jpg}
# Strengthening the GraphQL API
## with the power of Greyskull
### Narrated by Jisse Reitsma

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of backend and frontend developers
  - Magento, React, PWA Studio, Vue Storefront, GraphQL
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2)
~ Creator of Reacticon v3 or v4 (June 2021)
~ Magento Master 2017/2018/2019 Mover
~ Member of ExtDN (Magento Extension Developer Network)

---
{state: main middle dark}
{background-image: heman/greyskull.jpg}
# Current state 
# of Magento GraphQL

---
# Current state
- Coverage of endpoints is nearing completion
    - URL resolving, categories, products, CMS, PageBuilder
    - Customer mutations, addressbook
    - Support for Configurable Products, swatches
    - Add-to-cart, product options
- All that is there is stable
- Fuzzy roadmap

@todo: Is it possible to build a PWA with it? Downsides?

---
# What is still missing?
- Support for payment gateways
- @todo
- Performance?
- Security?

---
# Strengthening GraphQL performance

---
# Full Page Cache for GraphQL
- Magento-based FPC for GraphQL endpoints
  - Currently non-existent
- Varnish-based FPC
- Middleware-based FPC

---
# Using Varnish
@todo: What needs to be configured
@todo: Downsides & upsides

---
# Using Apollo Server
@todo: caching

---
# Other points
@todo: https://www.apollographql.com/blog/securing-your-graphql-api-from-malicious-queries-16130a324a6b
@todo: https://www.howtographql.com/advanced/4-security/
@todo: Set PHP timeout and memory_limit (at least for GraphQL queries) relatively low (separate PHP-FPM)

---
# Strengthening GraphQL security

---
# GraphQL security
- Exploits of GraphQL endpoints
  - Input arguments, output of data
- Query depth
- Query complexity
- Throttling

---
@todo: https://github.com/yireo/Yireo_GraphQlRateLimiting

---
@todo: https://github.com/yireo/Yireo_CustomGraphQlQueryLimiter

---
# The Apollo way
@todo: GraphQL limiting with Apollo Gateway?

---
# No headless shop?
- Make sure to disable all GraphQL modules
  - `bin/magento module:disable $(bin/magento module:list --enabled | grep -i graphql)`
- Or even better, remove these modules
  - See https://github.com/yireo/magento2-replace-graphql

---
{state: main middle dark}
{background-image: heman/power.gif}
# We have the power

---
{state: main middle dark}
{background-image: heman/heman-shera.jpg}
# Thanks
## Contact me via @jissereitsma or @yireo
