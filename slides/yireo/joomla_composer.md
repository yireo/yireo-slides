layout: true
<div class="slide-heading">Joomla & composer</div>

---
class: center, middle
# Using composer
## in custom Joomla projects

---
# Composer in Joomla
- Folder `libraries/vendor`
    - Joomla Framework packages
    - Symfony Framework packages
    - PHP libsodium compatibility
    - PHPMailer
    - PSR logger
    - Composer itself

---
# Problems with this approach
- No `composer.lock` or `composer.json`
- Located in subfolder `libraries`
- Part of Joomla core
    - No core hacks!

---
class: center, middle
# Solution:
## Use folder `vendor` instead

---
# Sample Joomla project
- `libraries/vendor`
- `modules`
- `plugins`
- `vendor`

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

