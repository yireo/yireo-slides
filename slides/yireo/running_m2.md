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
- Founder and lead developer of Yireo
- Trainer, enterpreneur, coder
- Wrote 2 developer books for J\*\*ml\*
- Embracing Magento 2

---
# Disclaimers
- I am not a runner
- Difference between running from running
    - Operations vs performance
- I am no god
    - Known configurations
    - Best practices
    - Perhaps some insights

---
# Running Magento 2
- PHP 7 + Zend OPcache
- Nginx + PHP-FPM
- Redis caching
- MySQL 5.6 (or alternative) + tuning
    - Query cache, InnoDB buffers
- composer / magerun2
- CI tools
    - phpcs, phpmd, Phing/Capistrano/Fabric

---
# Optionals
- Varnish
- appserver.io
- Tarantool instead of Redis
- Clustering
    - MySQL master/slave, M2 EE
- Offloading search
    - Solr, ElasticSearch

---
class: center, middle
# Performance

---
# PHP 7
- Drop HHVM
- Tune Zend OPcache
    - `opcache.validate_timestamps=0`
- Recompile PHP with PGO
    - PGO = Profile-Guided Optimization
- Enable `huge_code_pages` in kernel
    - Not page size of 4k but of 2m

---
# Turning off
- ionCube
- Xdebug
- NewRelic, Zend Z-Ray, Blackfire
- MySQL performance schemas

---
class: center, middle
# Operations

---
# Magento 2 specifics
- No code generation of live server
    - Not running `magento setup:di:compile`
    - Committing `var/generation` to git
- No composer updates on live server
    - Committing `composer.lock` to git
    - Optimize autoload file (`--optimize-autoloader`)
    - Use `prestissimo` for faster downloads
    - Use Satis or Toran Proxy for offloading
- Interceptors instead of event observers
    - Interceptor count matters less due to code generation
    - Count of dispatched events does matter
- Copying static view files using Grunt / Gulp

