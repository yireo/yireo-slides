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
    - Product slider, Lightbox, tabs
- Connections (event-based?)
    - ERP, CRM, PIM
- Checkout-based
    - Payment providers
    - Shipping providers
    - Tax calculation

---
{state: dark}
# Headless changes things a lot
- Backend logic is the same; Only the frontend changes
- We can easily build stuff ourselves

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
~ React component receiving `props` from above
    - Above = Parent component or Redux or Apollo
~ Add a sample parent component
    - Axios to make a simple GraphQl component
    - Possibly with end-to-end testing or *unit* tests

---
{state: dark}
# What kind of extensions are there?
- Themes
- Frontend widgets
    - Product slider, Lightbox, tabs
- Connections (event-based?)
    - ERP, CRM, PIM
- Checkout-based
    - Payment providers
    - Shipping providers
    - Tax calculation

---
{background-image: pwa/giphy-not-really.webp}
## Done

---
{state: bordered}
{background-image: mm18pl/ross-kemp-folded.jpg}
# Folded together for you
## slides.yireo.com/yireo/pwa_extensions
Kudos to Ross-Kemp-Folded