layout: true
<div class="slide-heading">Joomla & composer</div>

---
class: center, middle
# Using composer
## in custom Joomla projects

---
# Composer in Joomla
- `libraries/vendor`
    - Joomla Framework packages
    - Symfony Framework packages
    - PSR logger
    - Composer itself

---
# Problems
- No `composer.lock` or `composer.json`
- Located in subfolder `libraries`
- Part of Joomla core
    - No core hacks!

---
class: center, middle
# Solution
## Use `vendor` instead

---
class: center, middle
# How?

---
# How?
- `composer require vendor/module`
- Load `vendor/autoload.php` file in Joomla
- 

---
# Example: Moneybird

