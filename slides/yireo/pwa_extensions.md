{state: main}
## How Magento extensions will fit into PWA
# back to the future I
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

---
{state: main}
### The hype
# What is PWA?

---
{state: main}
### The hype
# Painfully Wishful Acronym

---
{state: main}
## Is Magento PWA ready?

---
{background-image: pwa/giphy-indian.webp}

---
{state: main}
## Is Magento PWA ready
# ... for merchants?

---
{state: dark}
# What do you mean?
### An all-purpose, multi-fit, mega-cool PWA-solution that you can generate from within the Magento Admin Panel, customize it using a magic dashboard that has all possible Mickey Mouse combinations thought out for you while still being completely understandable to any backend user and extensible with any Magento extensions out there in the market?

---
{background-image: pwa/giphy-nope.webp}
# Keep dreaming, dudes, keep dreaming

---
{state: main}
## Is Magento PWA ready
# ... for developers?

---
{state: dark}
# What do you mean?
### A PWA-solution that is custom built in React, Vue or Angular by some kick-ass frontend developers that know their Kungfu-coding shit and can custom-build any extension-like feature for you, assuming your wallet is large enough?

---
{background-image: pwa/giphy-okay.webp}
# Yes! PWA is ready! We are ready!

---
{state: main}
## Is Magento PWA ready
# ... for extensions?

---
{background-image: pwa/giphy-not-really.webp}

---
{state: dark}
# What kind of extensions are there?
- Themes
- Frontend widgets
- Connections with external systems
- Checkout-based

---
{state: dark}
# The GraphQL API is here
~ GraphQL is the future of the API
~ It is possible to create your own GraphQL endpoint
    - Query
    - Mutation
~ Just add 2 files
    - `schema.graphqls`
    - PHP class with `resolver()` method

---
{state: dark}
# It is easy to make a GraphQL call
```json
{
  products(search: "Hood") {
    items {
      id
      sku
      name
  }
}
```

~ Within React or Vue: Apollo client
~ Within any JavaScript: Axios
~ Within the current frontend: jQuery

---
{state: dark}
# Strategy
~ Make your code solid
    - Document your dependencies in `composer.json` and `module.xml`
~ Split up your current extension
    - `Foobar` - Meta-package
    - `FoobarApi` - API interfaces
    - `FoobarAdmin` - UiComponents (grids, forms), `system.xml`, `view/adminhtml`
    - `FoobarFrontend` - XML layout, Blocks, PHTML, `view/frontend`
    - Possibly a separate PHP non-Magento library
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
~ Add simply integration tests for this
    - PHPUnit tests with CURL to check JSON-response

---
{state: dark}
# FoobarReact
~ Marked as experimental
~ Distributed as a NPM package (npmjs.com, ZIP)
    - Clear `npm install` procedure
~ React component receiving `props` from above
    - Above = Parent component or Redux or Apollo
~ Add a sample parent component
    - Axios to make a simple GraphQl component
    - Developer documentation
    - Possibly with end-to-end testing or *unit* tests
~ Possibly integrate this into the current Knockout frontend
    - If you want to be part of the cool kids (Jisse + 1)
    - Example: `Yireo_ReactMinicart`

---
{state: dark}
# Headless changes things a lot
~ Backend logic is the same
~ Only the frontend changes
    - React or Vue
~ And we can easily build stuff ourselves within that new frontend
    - Get started and you will see
~ And so can extension developers
    - Ready-made React or Vue components based on GraphQl

---
{state: dark}
# What kind of extensions are there?
- Frontend fluff
- Connections with external systems
- Marketing tools
- Checkout-based extensions

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
~ Possibly have themes available for React & Vue
    - It is just HTML, CSS and bit of JavaScript
    - CSS Zen Garden (2001) anyone?

---
{state: dark}
# Extensions: Connections with external systems
~ Examples:
    - ERP, CRM, fraud, bookkeeping
    - Warehouse management, PIM
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
{state: dark}
# Current state of Magento PWA Studio
~ Magento PWA Studio is at version 2.1.0
~ But: Venia is a PROOF OF CONCEPT
~ But: REST-hacks to get things working
~ But: Braintree is only payment option
~ But: No selection for shipment provider
~ Reason: GraphQL API is not complete yet

---
{state: dark}
# Current state of GraphQL
~ Product, category, CMS, customer
~ Checkout slowly beginning to be covered
    - Empty cart
    - Authentication
    - Basic Checkout end-to-end flow
~ It is done when it is done

---
{state: dark}
# Extensibility in PWA Studio


---
{state: bordered}
{background-image: mm18pl/ross-kemp-folded.jpg}
# Folded together for you
## slides.yireo.com/yireo/pwa_extensions
Kudos to Ross-Kemp-Folded