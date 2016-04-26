layout: true
<div class="slide-heading">Jisse Reitsma (Yireo) - Running Magento 2</div>
<div class="slide-footer">
    <span>Yireo - Opening Up Technologies - slides.yireo.com</span>
</div>

---
class: center, middle
# Running Magento 2

---
# About me
- Jisse Reitsma
--

- Founder and lead developer of Yireo
--

- Trainer, enterpreneur, coder
--

- Wrote 2 developer books for J\*\*ml\*
--

- Part of Zend Z-Team
--

- Loving Magento 2
--

- I live near a palace

---
# Disclaimers

--
- I do not live in a palace

--
- I am not a runner

--
- I am just a simple Dutch guy
    - Bits of cool stuff
    - Some best practices
    - Perhaps some insights?
--
- Difference between running from running
    - Operations vs performance

---
class: center, middle
# Running Magento 2
### Performance

---
# Environment
- PHP 7 + Zend OPcache

---
# Environment
- PHP 7 + Zend OPcache
- Nginx + PHP-FPM
    - PHP-FPM via UNIX socket?
    - HTTP/2

---
# Environment
- PHP 7 + Zend OPcache
- Nginx + PHP-FPM
- Redis caching
    - Multiple Redis databases

---
# Environment
- PHP 7 + Zend OPcache
- Nginx + PHP-FPM
- Redis caching
- MySQL 5.6 (or alternative) + tuning
    - Query cache, InnoDB buffers

---
# Environment
- PHP 7 + Zend OPcache
- Nginx + PHP-FPM
- Redis caching
- MySQL 5.6 (or alternative) + tuning
- composer
    - Optimize autoload file (`--optimize-autoloader`)

---
# Environment
- PHP 7 + Zend OPcache
- Nginx + PHP-FPM
- Redis caching
- MySQL 5.6 (or alternative) + tuning
- composer
- magerun2
    - Magerun2 addons from Hypernode: Patching, updates

---
# Environment
- PHP 7 + Zend OPcache
- Nginx + PHP-FPM
- Redis caching
- MySQL 5.6 (or alternative) + tuning
- composer
- magerun2
- CI tools
    - phpcs, phpmd, Phing/Capistrano/Fabric

---
# Optionals
- Varnish
    - VCL file generated through Magento 2
- Clustering
    - MySQL master/slave, M2 EE
- Offloading search
    - Solr, ElasticSearch

---
# PHP 7
--

- Ditch HHVM / Hurray for Zend
--

- Tune Zend OPcache
    - `opcache.validate_timestamps=0` ?
    - Reload PHP-FPM instance after git pull
--
- Recompile PHP with PGO
    - PGO = Profile-Guided Optimization
--
- Enable `huge_code_pages` in kernel
    - Not page size of 4k but of 2m

---
# Turning off
- ionCube
--

- Xdebug
--

- NewRelic, Zend Z-Ray, Blackfire
--

- MySQL performance schemas

---
# Experimental
--

- appserver.io
    - Wait for 06/2016 release for PHP 7
--
- Tarantool or Aerospike instead of Redis
    - github.com/danslo/Rubic_Cache_Backend_Aerospike
--
- Hack from HHVM

---
class: center, middle
# Running Magento 2
### Operations

---
# Magento 2 operations
- No code generation of live server
    - Not running `magento setup:di:compile`
    - Committing `var/generation` and `var/di` to git?
--
- No composer updates on live server
    - Committing `composer.lock` to git (?)
    - Use `prestissimo` for faster downloads
    - Use Satis or Toran Proxy for offloading

---
# Magento 2 operations
- Interceptors instead of event observers
    - Interceptor count matters less due to code generation
    - Count of dispatched events does matter
    - But events are less confusing than interceptors
--
- How to analyse DI properly?
    - Preferences, types, virtual types, plugins
    - Circular dependencies reports do not help
    - magento-hackathon/magento2-plugin-visualization

---
# Magento 2 operations
- Deploying static view files
    - Use Grunt / Gulp instead
    - Specify what you want to deploy (PR @denisristic)
    - Other stuff we did on Monday

---
class: center, middle
# Q&A
