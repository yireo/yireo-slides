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
{state: light middle}
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
{state: light}
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
{state: light middle}
# Conclusion: Change is hard.

---
{state: light middle}
# My conclusion: Change needs to be enforced.

---
{state: light}
# Name one bad extension provider
~ Starting with the letter `A`
~ With 6 letters in total
~ From Belarus
~ Ending with `ty`
~ And it is NOT `Amosty`

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
{state: light middle}
# Rating: 87

---
{state: light middle}
# Drop the legacy

---
{state: light middle}
# How to drop the legacy?

---
{state: light}
# Tools
- Running things yourself
    - PHPCS, PHPStan
    - Security scanners
- Magento Marketplace validation
    - PHPCS, MFTF, Varnish tests
- Testing
    - Unit, integration, end-to-end, functional

---
{state: light}
# Validation sites
- NrJudge
- Triplecheck.io


---
@todo: the good, the bad, the ugly
@todo: trustworthy extensions, reality check with ExtDN
@todo: test install M2.X, PHP7.X, di compile
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
{state: light middle}
# Drop the legacy

---
{background-image: magetitans-nl/mic_drop.gif}
{state: light}
# All right
# Thanks