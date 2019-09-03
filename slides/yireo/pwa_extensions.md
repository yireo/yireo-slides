{state: dirtyharry main middle}
# How Magento extensions will fit into PWA
## aka: Do you like magic tricks? 
#### by Jisse Reitsma (Yireo)

---
{state: speaker}
{background-image: pwa/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of Magento 2 developers
~ Creator of MageTestFest & Reacticon
~ Organizer of usergroups, hackathons
~ Magento Master 2017-2019 Mover
~ Member of ExtDN (Magento Ext Dev Network)
~ Promoter of PWA something

---
{state: garden main center middle}
# PWA is ready!

---
{state: desert2 main center middle}
### Progressive Web Apps or
# Painfully Wishful Acronym

---
{state: garden3 main center middle}
# Is Magento ready for PWA?

---
{state: garden3 main center middle}
# YES!

---
{state: light center middle}
# But no ...

---
{state: light center middle}
# But yes ...

---
{background-image: pwa/background-vicky.png}
### Vicky Pollard - Little Britain

---
{state: light}
# What does PWA mean?
- Manifest file for theming
- Service worker
- Push notifications
- Offline site

---
{state: light}
# What does PWA mean?
- ~~Manifest file for theming~~ (possible in current frontend)
- ~~Service worker~~ (possible in current frontend)
- ~~Push notifications~~ (possible in current frontend)
- Offline site

---
{state: main center}
{background-image: pwa/background-vicky-shocked.jpg}
# PWA is not about merchants

---
{state: light}
# PWA technology includes
- React or Vue
- Redux or Vuex
- GraphQL thanks to Apollo
- And lots of more tech stuff

---
{state: main center}
{background-image: pwa/background-vicky-happy.jpg}
# PWA is about developers

---
{state: light}
# Benefits of headless development
- Modern technology
- Separation frontend and backend team
- Fun refactoring of React or Vue components
- Easier output testing with GraphQL
- Faster development time

---
{state: main center middle}
# So why are Magento extensions not PWA ready yet?

---
{background-image: pwa/background-vicky.png}
### Dunno

---
{state: dark}

---
{state: dark center middle}
# What is needed?

---
{background-image: pwa/background-car.jpg}
{state: main center middle}
# Something GraphQL

---
{state: dark}
# GraphQL (server-side)
~ GraphQL is the future of the API
    - Definitely when it comes to PWA solutions
~ It is possible to create your own GraphQL endpoint
    - Query
    - Mutation
~ Just add 2 files to your module
    - `schema.graphqls`
    - PHP class with `resolver()` method

---
{state: dark}
# GraphQL (client-side)
A query is easy to put together:
```json
{
  products(search: "Hood") {
    items {
      id, sku, name
  }
}
```

~ Within React or Vue: Apollo client
~ Within any JavaScript: Axios
~ Within the current frontend: jQuery

---
{background-image: pwa/background-factory.jpg}
{state: main center middle}
# Something refactoring

---
{state: dark}
# Strategy of refactoring
~ Make your code solid
    - Document your dependencies in `composer.json` and `module.xml`
~ Split up your current extension
    - `Foobar` - Meta-package or core package
    - `FoobarApi` - API interfaces, extension points
    - `FoobarAdminhtml` - UiComponents (grids, forms), `system.xml`, `view/adminhtml`
    - `FoobarFrontend` - XML layout, Blocks, PHTML, `view/frontend`, widgets
    - Possibly a separate PHP non-Magento library (`FoobarLibrary`)
~ Add new packages
    - `FoobarGraphQl`
    - `FoobarReact`

---
{state: dark}
# FoobarGraphQl
~ Maybe not installed by default?
    - Composer `suggests`?
~ Depending on `Magento_GraphQl`
    - Or possibly other modules like `Magento_CatalogGraphQl`
~ Add simple integration tests for this
    - PHPUnit tests with CURL to check JSON-response

---
{state: dark}
# FoobarReact
~ Marked as experimental
~ Distributed as a NPM package (npmjs.com, ZIP)
    - Clear `npm install` procedure
~ React component receiving `props` from above
    - Above = Parent component or Redux or Apollo (or `data-mage-init`)
~ Add a sample parent component
    - Axios to make a simple GraphQl component
    - Developer documentation on how to use `props` and event handlers
    - Possibly with end-to-end testing or *unit* tests or something
~ Possibly integrate this into the current Knockout frontend
    - If you want to be part of the cool kids (Jisse + 1)
    - Example: `Yireo_ReactMinicart`

---
{state: main center middle}
### So, providing a GraphQL endpoint
### plus a React component is pretty easy

---
{state: dark}
# My vision of the future
~ Headless will fundamentally change Magento
~ Backend logic remains the same
~ Frontend changes dramatically
    - People will use React or Vue or something else
~ And we can easily build stuff ourselves within that new frontend
    - Get started with React and/or Vue and you will see how easy it is
~ And equally, extension developers can easily build stuff
    - Ready-made React or Vue components based on GraphQl endpoints

---
{state: dark}
# Actionable items
- For merchants
- For system integrators
- For Magento (Adobe)
- For extension providers

---
{state: dark}
# Actionable items for merchants
- Understand PWA without the marketing stuff
- Realize that the current M2 frontend is doomed
- Realize that the new headless approach is the future
- Determine when you want to invest
    - The current frontend makes both extensions and custom work more expensive
    - The new frontend requires more custom work, but is dead-easy

---
{state: dark}
# Actionable items for system integrators
- Do not promote the marketing stuff of PWA
- Be realistic about the current M2 frontend being doomed
- Be realistic about the new headless being the future
- Start playing with React or Vue
- Start playing with PWA Studio, DEITY or VueStoreFront
- Realize that you will no longer be a *Magento specialist*
    - Because there is also React, Vue, Redis, MySQL, ElasticSearch, Varnish, RabbitMQ, etcetera
    - You are a specialist of a broader e-commerce stack

---
{state: dark}
# Actionable items for Magento
- Separate logic from output
    - Venia UI versus Redux/Apollo layer
- Allow for extensibility
    - Especially in the checkout

---
{state: dark}
# Extensions: Frontend fluff
~ Examples:
    - Product slider, Lightbox, tabs
    - Social media widgets, live chat
    - Point of Sales (POS) systems
    - Themes
~ We can easily build this stuff ourselves
    - This is why we want an easier frontend
~ Or have extension providers offer ready-made Vue or React components
~ Or find ready-made Vue or React components elsewhere
~ And possibly have themes available for React & Vue
    - It is just HTML, CSS and bits of JavaScript to output stuff
    - CSS Zen Garden (2001) anyone?

---
{state: dark}
# Extensions: Connections with external systems
~ Examples:
    - ERP, CRM, fraud detection, bookkeeping
    - Warehouse management, PIM, POS
    - Importing tools, exporting tools
~ Technology: Observable events & Interceptors
~ This is backend related
~ This should still work with the new frontend

---
{state: dark}
# Extensions: Marketing tools
~ Examples:
    - Newsletters
    - SEO, SEM, advertizing
    - Rewards, loyalty, gift-cards
~ See earlier slides
    - Either based on frontend fluff
    - Or connections with external systems (under the hood)

---
{state: dark}
# Extensions: Checkout-based extensions
~ Examples:
    - Payment providers
    - Shipping providers
    - Tax calculation
    - Checkout enhancements
~ ... ahm, well, yeah ...

---
{state: garden3 main center middle}
### the hype:
# Is Magento PWA ready?

---
{state: dark}
# Current state of Magento PWA Studio
~ Magento PWA Studio is at version 2.1.0
    - Working catalog
    - Working customer login
    - Working add-to-cart
    - Working checkout with payment and shipping
~ But: Venia is a PROOF OF CONCEPT
~ But: REST-hacks to get things working
~ But: No selection of country yet
~ But: Braintree is only payment option
~ But: No selection for shipment provider
~ One possible reason: GraphQL API is not complete yet

---
{state: dark}
# Current state of GraphQL
~ Product, category, CMS, customer
~ Checkout slowly beginning to be covered
    - Empty cart
    - Authentication
    - Basic Checkout end-to-end flow
~ Magento 2.3.2 will give us many checkout endpoints
~ Full coverage is expected towards Q4 2019 / Q1 2020
    - Adding Configurable Products to cart
    - Advanced payment gateways
~ It is done when it is done

---
{state: city main center middle}
# It is in progress
### but where and when do extensions fit in?

---
{state: dark}
# Timeline for Magento PWA Studio
~ Build a proof-of-concept Venia theme
~ Support for all GraphQL endpoints
~ Move components to Peregrine library
~ Think about extensibility

---
{state: dark}
# General advice for extension providers
~ Build GraphQL endpoints
~ Supply sample React components (`create-react-app`)
~ Possibly supply sample Vue components
~ Communicate your PWA readiness

---
{state: dark}
# Alternative for payment gateways
~ Build it yourself
    - Form handling, AJAX exchange, callback URLs
~ Rely on NodeJS client offered by payment provider
    - Remote API, authentication, procedure

---
{state: dark}
# UPWARD
- Proxy between PWA & Magento
    - Or: A middle tier service layer between browser & server
- Unified Progressive Web App Response Definition
    - Mapping of properties, functions & data
    - No state
- Defined in YAML
- Multiple connectors available
    - NodeJS (f.i. for React, Vue)
    - PHP (f.i. for a Laravel app)
- Why?
    - Reusability of components and PWA-backends

---
{state: bordered}
{background-image: mm18pl/ross-kemp-folded.jpg}
# Folded together for you
## slides.yireo.com/yireo/pwa_extensions
Kudos to Ross-Kemp-Folded
