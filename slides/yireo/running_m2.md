layout: true
<div class="slide-heading">Jisse Reitsma - Running Magento 2</div>
<div class="slide-footer">
    <span>Yireo - slides.yireo.com</span>
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

- Grab a MUGMUG
--

- Part of Zend Z-Team
--

- Loving Magento 2
--

- I live near a palace

---
# The palace

<p class="center">
<img class="img-responsive" src="../slides/yireo/images/paleis.jpg" />
</p>

---
# Disclaimers

--
- I do not live in a palace

--
- I am not a runner

--
- I am just a simple Dutch guy

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

---
# PHP 7
- Hurray for Zend

---
# PHP 7
- Hurray for Zend
- Ditch HHVM

---
# PHP 7
- Hurray for Zend
- Ditch HHVM
- Tune Zend OPcache
    - `opcache.validate_timestamps=0` ?
    - Reload PHP-FPM instance after git pull

---
# PHP 7
- Hurray for Zend
- Ditch HHVM
- Tune Zend OPcache
- Recompile PHP with PGO
    - PGO = Profile-Guided Optimization

---
# PHP 7
- Hurray for Zend
- Ditch HHVM
- Tune Zend OPcache
- Recompile PHP with PGO
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

---
# Magento 2 operations
- No code generation of live server
- No composer updates on live server
    - Committing `composer.lock` to git (?)
    - Use `prestissimo` for faster downloads
    - Use Satis or Toran Proxy for offloading
    - Optimize autoload file (`--optimize-autoloader`)

---
# Magento 2 operations
- No code generation of live server
- No composer updates on live server
- Interceptors instead of event observers
    - Interceptor count matters less due to code generation
    - Count of dispatched events does matter
    - But events are less confusing than interceptors

---
# Magento 2 operations
- No code generation of live server
- No composer updates on live server
- Interceptors instead of event observers
- How to analyse DI properly?
    - Preferences, types, virtual types, plugins
    - Circular dependencies reports do not help
    - magento-hackathon/magento2-plugin-visualization

---
# Magento 2 operations
- No code generation of live server
- No composer updates on live server
- Interceptors instead of event observers
- How to analyse DI properly?
- Deploying static view files
    - Use Grunt / Gulp instead
    - Specify what you want to deploy (PR @denisristic)
    - Other stuff we did on Monday

---
class: center, middle
# Thanks
### Questions?
