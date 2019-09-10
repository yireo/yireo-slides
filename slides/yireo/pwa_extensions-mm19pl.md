{state: opening main middle}
# How Magento extensions will fit into PWA
## aka: What are we waiting for?
#### by Jisse Reitsma (Yireo)

---
{state: speaker}
{background-image: pwa/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of Magento 2 developers
~ Creator of MageTestFest & Reacticon
~ Organizer of usergroups, hackathons
~ Magento Master 2017/2018/2019 Mover
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
{state: dark center middle}
# Is PWA ready?

---
{state: garden3 main center middle}
# Is Magento ready for PWA?

---
{background-image: pwa/background-chernobyl.jpg}
{state: main center middle}
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
{state: dark center middle}
# So why are Magento extensions 
# not PWA ready yet?

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
{state: dark}

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
{state: dark}

---
{state: light center middle}
### So, providing a GraphQL endpoint
### plus a React component is pretty easy

---
{state: light center middle}
### So, then we wait

---
{state: dark}

---
{state: dark}
# My personal vision of the future
~ Headless will fundamentally change Magento
~ Backend logic remains the same
~ Frontend changes dramatically
    - People will use React or Vue or something else
~ And we can easily build stuff ourselves within that new frontend
    - Get started with React and/or Vue and you will see how easy it is
~ And equally, extension developers can easily build stuff
    - Ready-made React or Vue components based on GraphQl endpoints

---
{state: light center middle}
### How to change from passive into active?

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
~ Understand PWA without the marketing stuff
~ Realize that the current M2 frontend is doomed
~ Realize that the new headless approach is the future
~ Determine when you want to invest
    - The current frontend makes both extensions and custom work more expensive
    - The new frontend requires more custom work, but is much easier to work with

---
{state: dark}
# Actionable items for system integrators
~ Do not promote the marketing stuff of PWA
~ Be realistic about the current M2 frontend being doomed
~ Be realistic about the new headless being the future
~ Get started with headless technology
    - Start playing with React or Vue
    - Start playing with PWA Studio, DEITY or VueStoreFront
    - Do not build your own PWA solution
~ Realize that you will no longer be a "Magento specialist"
    - Because there is also React, Vue, Redis, MySQL, ElasticSearch, Varnish, RabbitMQ, etcetera
    - You are a specialist of a broader e-commerce stack

---
{state: dark}
# Actionable items for Magento
~ Separate logic from output
    - Venia UI versus Redux/Apollo layer
~ Allow for extensibility
    - Patterns for presentational versus 
~ Especially in the checkout
    - Patterns for payment providers
    - Patterns for shipment providers
    - Hooks for discounts, steps, etcetera

---
{state: light center middle}
### And then the extension providers

---
{state: light center middle}
### They are waiting

---
{state: dark}
# Actionable items for extension vendors
~ Build GraphQL endpoints
    - Separate module with a composer dependency for Magento 2.3
~ Supply sample React components
    - Stand-alone or shipped with `create-react-app`
    - Public NPM packages or a simple ZIP
~ Possibly supply sample Vue components
    - If you like VueStoreFront
    - Or if you want to make money from VueStoreFront fans as well
~ Communicate your PWA readiness
    - A simple `PWA.md` doc with a few comments
    - Perhaps stating nothing is needed

---
{state: light center middle}
### Stop waiting

---
{state: light center middle}
### Start playing

---
{state: main dark center middle}
{background-image: pwa/background-new-york.jpg}
# We are ready for PWA
## slides.yireo.com/yireo/pwa_extensions
