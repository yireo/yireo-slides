layout: true
<div class="slide-heading">Joomla & composer</div>

---
class: center, middle
# Using composer
## in custom Joomla projects

---
# Composer in Joomla
- `libraries/vendor`

---
# Problems
- No `composer.lock` or `composer.json`
- Located in subfolder `libraries`
- Part of Joomla core
    - No core hacks!

---
# Solution
Use `vendor` instead

---
# How?
- `composer require vendor/module`
- Load `vendor/autoload.php` file in Joomla
