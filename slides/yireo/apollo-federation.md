{state: main}
{background-image: mm18uk/background-mm.png}
# Magento in an Apollo Federation

---
# Magento legacy
- Monolithic architecture
  - Magento 1 and Magento 2 were designed as full service applications
- Frontending in Magento 2 is horrible
  - KnockoutJS, RequireJS, jQuery, all mixed in a deadly cocktail
  - Frontend is slowly becoming deprecated
- Magento 2.4 introduces SOA
  - SOA: Service Oriented Architecture
  - Not necessarily microservice, but more like independent services
- Magento is now owned by Adobe
  - Adobe is not making money of open source shops

---
# Magento goes headless
- Magento 2.3 introduced GraphQL API
- Magento is working on its own PWA Studio toolbox
  - React, Redux, Apollo Client, GraphQL
- Competitors are busy as well
  - Vue Storefront, FrontCommerce, DEITY, ScandiPWA

---
# Breaking up a monolith
- Catalog
- Inventory
- Checkout
- Sales Processing
- Image management
- Content management

---
# Direct benefits of headless
- Easier frontend development
- Use a proper CMS for content
- Faster inventory management
@todo

---
# Potential other microservices
- Image processing
- Product Information Management (PIM)
@todo

---
# The GraphQL story
- Try to have all microservices talk GraphQL
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
  - Maybe not a goal on itself, but at least something to consider
