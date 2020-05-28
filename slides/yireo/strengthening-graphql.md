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
~ Coverage is nearing completion

---
# GraphQL coverage
- URL resolving, categories, products, CMS, PageBuilder
- Customer mutations, addressbook
- Support for Configurable Products, swatches
- Add-to-cart, product options, gift cards
- Inventory

---
# Still fuzzy or missing or incomplete?
~ Proper implementation of payment endpoints by extension providers (?)
~ VAT validation, quote estimation (?)
~ Better ideas for extensibility of checkout (?)
~ Server-side query caching (?)

---
# Current state
- Coverage is nearing completion
~ What you need is there
    - Quick responses, even without caching
    - Extensible by third party extensions
    - Extensible by any Magento backend developer
    - Stable, I guess
~ Fuzzy roadmap
    - https://github.com/magento/graphql-ce/wiki/Roadmap
    - Not updated since Sept 18, 2019

---
{state: main middle dark}
{background-image: heman/orko1.jpg}
# Are you feeling fuzzy?

---
# Reflection on PWA
~ GraphQL forms the glue between a PWA and Magento-as-a-Backend (MaaB)
~ A PWA can be created using frontend tech of your choice
~ For instance, you could use React, like some Magento PWA Studio people did
~ Magento PWA Studio is not a PWA, it is a studio
~ Maybe the GraphQL API is nearing complete coverage. Magento PWA Studio is not.
~ Who cares? React is easy as hell and you can rapidly develop features with it
~ The point of headless is to separate the frontend from the backend
~ The point is not to be scared of anything that is not developed by Magento itself
~ Can you build a PWA with the current Magento PWA Studio and GraphQL API?
~ Yes! Assuming that you understand its implications.

---
{state: main middle dark}
{background-image: heman/heman-skeletor.webp}
# Is that your phone?

---
{state: main middle dark}
{background-image: heman/greyskull1.jpg}
# What about 
# performance 
# and security?

---
{state: main middle}
# Strengthening GraphQL performance

---
# Full Page Cache for GraphQL
- Magento-based FPC for GraphQL endpoints
  - Currently non-existent
- Varnish-based FPC
- Middleware-based FPC
  - Apollo Server
  - Relay Server

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
