{state: main middle dark}
{background-image: heman/heman-rainbow.jpg}
# Strengthening the GraphQL API
### with the power of Greyskull

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of backend and frontend developers
  - Magento 2 React, PWA Studio, Vue Storefront, GraphQL
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2)
~ Creator of Reacticon v3 or v4 (June 2021)
~ Magento Master 2017/2018/2019 Mover
~ Member of ExtDN (Magento Extension Developer Network)

---
# Overview of the GraphQL API

---
# Current state
@todo: Coverage of endpoints
@todo: Roadmap
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
# Strengthening GraphQL security

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
# @todo: Something smart

---
{state: main middle dark}
{background-image: apollo/bg-startrek.png}
# Thanks
## Contact me via @jissereitsma or @yireo
