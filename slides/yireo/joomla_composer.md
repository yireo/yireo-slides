layout: true
<div class="slide-heading">Joomla & composer</div>

---
class: center, middle
# Using composer
## in custom Joomla projects

---
# Composer in Joomla
- Folder `libraries/vendor/`
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
## Use folder `vendor/` instead

---
# Sample Joomla project
- `components/`
- `modules/`
- `plugins/`
- `templates/`
- `libraries/vendor/`
- `vendor/`
- `composer.json`
- `composer.lock`

---
class: center, middle
# How?

---
# How?
- Shell command `composer require a/b`
- Load `vendor/autoload.php` file in Joomla
- Use `a/b` library in your code

---
# Using composer
- Login to a shell

---
class: center, middle
# Example: GitHub repos


---
class: center, middle
# Example: Moneybird

---
# Difficulties
- Version management
    - `git`
- Deployment
    - Simple copy of files
    - Capistrano, Deployer, Phing
- Updates
    - Joomla click-click-click versus `composer update`

---
# Tips
- Use the Joomlatools Composer Installer
    - https://github.com/joomlatools/joomlatools-composer
- If you have a good composer module, dump it on Packagist
