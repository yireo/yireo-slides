{state: main middle}
## How can we enforce better Magento extensions?
# Drop the legacy
#### by Jisse Reitsma (Yireo)

---
{state: speaker}
{background-image: pwa/jisse.jpg}
# );sse Reitsma
~ Founder of Yireo
~ Trainer of Magento 2 developers
~ Creator of MageTestFest & Reacticon
~ Organizer of usergroups, hackathons
~ Magento Master 2017-2019 Mover
~ Member of ExtDN (Magento Ext Dev Network)

---
{state: light middle}
# How can we enforce better Magento extensions?

---
{state: light middle}
# We can't

---
{state: light}
# My talk
~ Obvious points about extension quality
~ Bits of psychology
~ Bits of ranting
~ Enlighted points
~ A lot of bullet points like these

---
{state: light}
# Obvious points about extension quality
~ Comply to the coding standards
    - Magento Coding Standard (consolidation project)
~ Add testing
    - Unit tests, integration tests, MFTF, acceptance tests
~ Don't inject the ObjectManager
    - Except in factories, proxies, builders, tests and more
~ Don't overwrite core preferences
    - Unless your module's purpose is exactly that
~ And so on ...


---
{state: light}
# Bits of psychology
~ Greed
    - Extension providers want to make money
    - Merchants want to safe money
~ 

---
{state: light middle}
# Name one bad extension provider
~ Starting with the letter `A`
~ With 6 letters in total
~ From Belarus
~ Ending with `ty`

---
{state: light middle}
# Measuring quality
~ Not complying to coding standards
    - Not true for modern Amasty extensions
~ No automated tests
    - Amasty now busy gradually implementing unit tests (and integration tests)
~ Bad usage of `ObjectManager`
    - Last time I checked an Amasty extension, they did all correctly

---
{state: light middle}
# Drop the legacy

---
{state: light middle}
# How to drop the legacy

@todo: What makes an extension bad?
@todo: interoperability, conflicts, extensibility

---
@todo: NrJudge, Triplecheck.io
@todo: the good, the bad, the ugly
@todo: example code review
@todo: trustworthy extensions, reality check with ExtDN
@todo: overview of testing
@todo: overview of extension standards
@todo: PHPCS consolidation project
@todo: tools: PHPCS, PHPStan
@todo: test install M2.X, PHP7.X, di compile
@todo: Varnish test
@todo: Yireo Extension Checker
@todo: security
@todo: Marketplace: how to measure quality
@todo: average of PHPCS rules, rating
@todo: What to do with bad extensions?
@todo: Vision Adobe, headless, climate change, earthquakes

---
{state: light}
# What to do next?
- Send us your poor and your weak! [jisse@yireo.com](mailto:jisse@yireo.com)
- Support ExtDN
    - Spread flyers (thus knowledge)

---
{state: light}
# What to do next?
~ Do write documentation for everything;
~ Magecart is open revenue sharing, so great;
~ Don't build your own stock keeping. Use MSI;
~ If you want performance, choose Shopware;
~ With headless, you don't need CI anymore;
~ Clients love everyone except Bret;
~ React is better than Vue ...
~ ... except for Magento 2 checkout;
~ If you weren't at MageTestFest, you don't care about testing;

---
{background-image: magetitans-nl/mic_drop.gif}
{state: light}
# All right
# Thanks