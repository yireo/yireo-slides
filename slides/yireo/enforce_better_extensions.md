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
{background-image: magetitans-nl/wecant.gif}
{state: dark middle}
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
{state: dark}

---
{background-image: magetitans-nl/throwup.webp}
{state: dark middle}
# Review of a bad extension

---
{state: light}
# Review of a bad extension (1 of 3)
~ Dependencies
	- No `require` dependencies with framework or modules
	- PHP compatibility with PHP 5.5 (for an Magento 2 extension)
	- Not all dependencies are in `module.xml`
~ Coding standards
	- Prefixing internal variables with an underscore
	- Code not formatted in PSR-1 or PSR-2
	- Long methods with too many features
	- More than 10 code indents in a single class (Object Calisthenics)

---
{state: light}
# Review of a bad extension (2 of 3)
- ObjectManager stuff
	- Injecting ObjectManager instead of using DI properly
	- Calling upon the ObjectManager in PHTML templates via a hidden `factory()` method
	- Injecting dependencies via constructor DI and then not using those dependencies
	- Injecting too many dependencies via constructor DI: Code should be SOLID
	- Suddenly calling upon ObjectManager::getInstance somewhere in the code
	- Intercepting with an around() plugin where before() or after() is enough already
	- Relying on the ObjectManager to `get()` a singleton instance, and then still writing your own singleton method
~ Manual database queries
    - Manual SQL queries to write to configuration instead of using `\Magento\Framework\App\Config\Storage\WriterInterface`
    - Defining your own models & collections and then still resorting to manual SQL queries to call upon your tables
    - Inserting default configuration values via Setup-class instead of using `etc/config.xml`
    - Manual SQL queries in Setup-classes

---
{state: light}
# Review of a bad extension (3 of 3)
- Theming stuff
    - Using helpers in General
    - Too much logic in PHTML templates
    - Adding CSS instead of LESS
    - `<argument name="template" translate="true" xsi:type="string">sample.phtml</argument>` - templates are not translatable
~ Small stuff
    - Call-to-home via `controller_action_predispatch` event in backend
    - Base module that does a lot of hard work to add notifications on each backend page
    - No custom acl.xml for own backend pages and configuration settings (but still defining resources)
    - Adding inline HTML into a field render class, instead of using a PHTML template
    - Overriding classes using a DI preference rewrite, instead of using plugins or composition
    - Extending a class for no reason

---
{background-image: magetitans-nl/mordor.webp}
{state: dark middle}
# Rating: D

---
{state: light}
# Why is this bad?
- No requirements in composer, so no proper versioning
- Not extensible by other developers
- More CSS loaded in head 
- Hard to create theming overrides

This is costing money.

---
{state: light}
# Areas where bad extension cost
- Conflicts
- Extensibility
- Interoperability
- Security

---
{state: dark center middle}
# Bits of psychology

---
{background-image: magetitans-nl/guido.jpg}
{state: dark}
# Bits of psychology
~ Self-interest
    ~ Extension providers want to sell extensions
    ~ Merchants want to save money where they can
    ~ Developers want to go home at 17:00
    ~ Their managers want to drive Porshes 
~ Stubbornness
    ~ None of the groups above wants to change
    ~ You are always right. The other one is wrong.
    ~ You don't want your friends to be bullied at.

---
{background-image: magetitans-nl/tough.jpg}
{state: dark}
# Conclusion: Change is hard.

---
{background-image: magetitans-nl/panda.webp}
{state: dark}
# My conclusion: Change needs to be enforced.

---
{state: dark middle}

---
{state: light}
# Name one bad extension provider
~ Starting with the letter `A`
~ With 6 letters in total
~ From Belarus
~ Ending with `ty`
~ And it is NOT `Amnesty`

---
{state: light}
# Measuring quality
~ Not complying to coding standards
    - Not true for all modern Amasty extensions
~ No automated tests
    - Amasty is now gradually implementing unit tests (and integration tests)
~ Bad usage of `ObjectManager`
    - Last time I checked an Amasty extension, they did all correctly
~ And a lot of people are happy with Amasty
    - Amasty extensions work with Amasty extensions
    - Fair pricing of extensions

---
{background-image: magetitans-nl/minsk.jpg}
{state: dark middle}
# Rating: 87.42

---
{state: light middle}
# What does "rating" mean?

---
{state: light}
# Quality checking
- Doing it yourself
    - PHPCS, PHPStan, PHPMD
    - Security scanners: mwscan, eComscan
- Magento Marketplace validation
    - PHPCS, MFTF, Varnish tests
- Testing
    - Unit, integration, end-to-end, functional

---
{state: light}
# Validation sites
- NrJudge
- Triplecheck.io

(And Magento Marketplace)

---
{state: light}
# Different environments
- Magento 2.1, 2.2, 2.3
- PHP 7.0, 7.1, 7.2
- With and without Varnish
- In Developer Mode and Production Mode
~ Oh and let's add this later to it as well:
    - GraphQL, Apollo Server, PWA
    - ElasticSearch 5, 6
    - MySQL 5.6, 5.7, 8 (Oracle, MariaDb, Percona)

---
{state: light}
# The problem of rating
~ How to calculate the score?
    - Take average of X rules with Yes/No answer?
    - Number of unique PHPCS Warnings divided by number of rules?
    - What about false positives? Manual checking?
~ What to do with the rating?
    - Strike 3 and you're out?
    - When do you stop guiding an extension developer?
~ When to rate?
    - Every time a new release is uploaded? (free CI tool)
~ Edge cases
    - What about 1000s of low level warnings?
    - What about 1 major security issue?

---
{state: dark middle}
{background-image: magetitans-nl/puppy.webp}
# Rating is hard
## So let's focus on the bad extensions first

---
{state: light middle}
# If extensions are rated badly, still using them is straight-out stupid. But a reality check shows that people are still using bad extensions everywhere.

---
{state: dark middle}
# How to drop the legacy?

---
{state: light}
# Legacy in the Magento Marketplace
~ Magento Marketplace grew too quickly
    - Replacement of MagentoConnect legacy
    - Initial extension submission got in, but no checks for additional versions
~ Coding standards were (are?) not mature yet
    - Is using `json_encode` a security hazard?
    - How to check for bad usage with the Object Manager? Tests? Factories?

---
{state: light}
# Changes in Magento Marketplace
- MFTF becomes more important
- Automated testing is now done on every release
- EQP2 is going to open up tooling to the community
- Rating extensions is currently being investigated
- Kicking out extensions is currently being investigated

---
{state: dark}

---
{state: dark middle}
<h1>The night is darkest just before the dawn.</h1>
<h1 class="fragment">And I promise you, the dawn is coming.</h1>
<h4 class="fragment">Harvey (Two-Face) Dent from "The Dark Knight"<br/>before he changes into a psychotic SoB</h4>

---
{state: light}
# Challenges in the market
~ Two Face Magento
    - Magento versus Adobe
    - Community versus high-end enterprise
~ PWA versus monolithic
    - Drop the Knockout legacy and go PWA
    - Extension quality remains for backend only
~ Market is shifting
    - Small shop owners move elsewhere
    - Serious shop owners spend more on custom development
    - How do extensions fit into this new market?
~ Earth quakes
    - Because we are in Groningen
    - And we fired up too much gas

---
{state: light middle}
# What can we do together?

---
{state: dark middle}
{background-image: magetitans-nl/dogskissing.jpg}

---
{state: light}
# What can we do together?
~ Help with the relevant Magento projects
    - Magento Coding Standard (PHPCS)
    - Slack channels (marketplace, phpcs, testing)
~ Help with ExtDN
    - Spread the word on good extensions
    - Spread our flyers on quality and standards
~ Give us feedback
    - Bad extension code
    - Send us your poor and your weak! [jisse@yireo.com](mailto:jisse@yireo.com)

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
{state: light middle}
# Drop the legacy

---
{background-image: magetitans-nl/mic_drop.gif}
{state: light}
# All right
# Thanks