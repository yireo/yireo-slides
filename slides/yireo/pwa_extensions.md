{state: dirtyharry main middle}
# How Magento extensions will fit into PWA
## aka: Do you like magic? 
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
~ Grew tired of being called Knockout Jisse
~ Promoter of PWA something

---
{state: garden main center middle}
### the hype:
# PWA is ready!

---
{state: dark}
# Magento Announces Availability of PWA Studio (Jan 15th)
There’s no question that mobile is the most transformative force in retail today, a trend that was on full display throughout the 2018 holiday shopping season. According to the Adobe Analytics Holiday report, mobile traffic soared with more than half (51.4 percent) of traffic originating from smartphones alone yet mobile accounted for just 31 percent of revenue. This is a stark reminder that many retailers have yet to crack the code on improving mobile conversion rates and the complexity of building and optimizing experiences across channels.

Today, we are excited to announce the general release of Progressive Web Applications (PWA), a suite of tools for building online stores with app-like experiences that help merchants solve the mobile conversion dilemma and delivery highly personalized cross-channel experiences, in addition, new innovations across Adobe Experience Cloud that help retailers excel in CXM across physical and digital storefronts. [...]

---
{state: desert2 main center middle}
### Progressive Web Apps or
# Painfully Wishful Acronym

---
{state: garden3 main center middle}
### the hype:
# Is Magento PWA ready?

---
{background-image: pwa/giphy-indian.webp}

---
{state: garden3 main center middle}
# Is Magento PWA ready
### ... for merchants?

---
{state: dark}
# What do you mean with "Magento PWA" and "ready"?
### An all-purpose, multi-fit, mega-cool PWA-solution that you can generate from within the Magento Admin Panel, customize it using a magic dashboard that has all possible Mickey Mouse combinations thought out for you while still being completely understandable to any backend user and extensible with any Magento extensions out there in the market?

---
{state: dark center middle}
{background-image: pwa/giphy-nope.webp}
# Keep dreaming, dudes, keep dreaming.
### Magento PWA will not be ready like you think it will be.

---
{state: garden3 main center middle}
# Is Magento PWA ready
### ... for developers?

---
{state: dark}
# What do you mean with "Magento PWA" and "ready"?
### A PWA-solution that is custom-build in React, Vue, Angular or any other fancy coolkids JavaScript framework by some kick-ass frontend developers that know their Kungfu-coding shit and can custom-build any extension-like feature for you, assuming your wallet is large enough and you have the patience to guide them through whatever you were actually requiring for your project?

---
{state: dark center middle}
{background-image: pwa/giphy-okay.webp}
# Yeah, ok. I can build you a PWA.
### Magento PWA is ready for anyone willing to be an early adaptor

---
{state: garden3 main center middle}
# Is Magento PWA ready
### ... for extensions?

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
{state: city main center middle}
# A bit on GraphQL

---
{state: dark}
# GraphQL is easy (server-side)
~ GraphQL is the future of the API
~ It is possible to create your own GraphQL endpoint
    - Query
    - Mutation
~ Just add 2 files
    - `schema.graphqls`
    - PHP class with `resolver()` method

---
{state: dark}
# GraphQL is easy (client-side)
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
{state: city main center middle}
# Refactor modules

---
{state: dark}
# Strategy of refactoring
~ Make your code solid
    - Document your dependencies in `composer.json` (?) and `module.xml`
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
{state: mountains main center middle}
# Which extensions need to change
### to support a PWA platform?

---
{state: dark}
# Headless changes things a lot
~ Backend logic remains the same
~ Frontend changes dramatically
    - People will use React or Vue or something else
~ And we can easily build stuff ourselves within that new frontend
    - Get started with React and/or Vue and you will see how easy it is
~ And equally, extension developers can easily build stuff
    - Ready-made React or Vue components based on GraphQl endpoints

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
{state: city main center middle}
# And now you wait
### if you are only a Magento developer?

---
{state: dark}
# What can we do NOW?
~ Ask extension providers to:
    - Build GraphQL endpoints for queries & mutations
    - Supply sample React components for those endpoints
    - Refactor monolithic module in smaller single-purpose modules
~ Ask PWA providers to:
    - Support UPWARD standard
    - Examples: DEITY, Vue StoreFront, FrontCommerce
~ Ask payment (and shipment) providers to:
    - Supply NodeJS client (and samples)
    - Preferably supply sample React components
    - Feature async payment for trusted customers
~ Ask the Magento PWA Studio team to:
    - Re-activate `extension.json` (or something else layout-like)
    - Be clear on the extension points (and extensibility) of Venia
~ Wait for some really smart Magento folks to complete the GraphQl API
    - Or join them on Slack and GitHub!

---
{state: bordered}
{background-image: mm18pl/ross-kemp-folded.jpg}
# Folded together for you
## slides.yireo.com/yireo/pwa_extensions
Kudos to Ross-Kemp-Folded
