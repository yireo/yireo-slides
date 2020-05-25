{state: main middle dark}
{background-image: apollo/bg-startrek.png}
# Magento in an Apollo Federation

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of developers
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2)
~ Creator of Reacticon v3 (June 2021)
~ Magento Master 2017/2018/2019 Mover
~ Member of ExtDN (Magento Extension Developer Network)

---
# Magento legacy
~ Monolithic architecture
  - Magento 1 and Magento 2 were designed as full service applications
  - Frontend, backend, API, CLI - all part of the same system
  - Modularity was not always designed properly with heavy coupling as a result
~ Frontending in Magento 2 is horrible
  - XML, PHTML, KnockoutJS, RequireJS, jQuery, custom JS - all mixed in a deadly cocktail
  - Hard to modify, difficult to debug and slow as hell
  - Frontend is slowly becoming deprecated
~ Magento 2.4 introduces SOA and many other cool features
  - SOA: Service Oriented Architecture
  - Not necessarily microservice, but more like independent services
  - This will take a long time to implement, even longer to get rid of the legacy
~ Magento is now owned by Adobe
  - Adobe is not making money of open source shops
  - Most effort goes into adding new advanced features, instead of cleaning up old stuff

---
{background-image: apollo/picard-laughing.gif}

---
# Magento goes headless
~ Magento 2.3 introduced GraphQL API
  - Support for catalog, checkout, customer, etc
~ Magento is working on its own PWA Studio toolbox
  - React, Redux, Apollo Client, GraphQL
~ Competitors are busy as well
  - Vue Storefront, FrontCommerce, DEITY, ScandiPWA

---
{background-image: apollo/picard-clapping.gif}

---
# Direct benefits of headless
- Easier frontend development
- Better performance
- Use a proper CMS for content
- Breaking up application is smaller pieces

---
# Breaking up an e-commerce monolith
- Catalog
- Inventory
- Checkout
- Sales Processing
- Image management
- Content management (CMS)
- Marketing rules
- SEO
- ...

---
# Potential other microservices
- Product Information Management (PIM)
- Caching service
- Price calculation
- Alternative inventory & stock
- VAT verification
- Email verification
- Dealers / retailer information
- Complex product options
- Promos and advertizing
- Image optimization
- Product image provider

---
# The GraphQL story
- Try to have all microservices talk GraphQL
  - We don't need a Universal Translator
- Different languages, different server packages
  - Node: Apollo, Relay
  - PHP: Webonyx, GraphQLite
- Let a frontend talk GraphQL too
  - Vue, React, Angular
  - Apollo, Relay, Axios
- Use Apollo Gateway

---
# The federation
- Basically Apollo Gateway with multiple microservices
- Separation of Concerns
- Principled GraphQL
  - Distributed GraphQL
  - Unified graph with a schema registry

---
# Why Apollo Federation?
- Easily merge schemas into single federated graph
- Slowly migrate backend sources from one service to another
  - Modifying requests and responses
  - Maintain schema registry within Apollo Graph Manager

---
# Scenario with Magento
- Build headless shop with Magento 2
- Connect frontend to Apollo Gateway
- Apollo Gateway connects to Magento
- Slowly migrate responsibility away from Magento 2
  - Using theory of Principled GraphQL

---
{state: main middle dark}
{background-image: apollo/picard-funny.gif}
## Maybe not a goal on itself
## but at least something to consider

{state: main middle dark}
{background-image: apollo/bg-startrek.png}
# Thanks
### @jissereitsma / @yireo
