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
# Normal Joomla project
- `components/`
- `modules/`
- `plugins/`
- `templates/`
- `libraries/vendor/`

---
# My Joomla project
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
# How to use composer?

---
# How to use composer?
- Shell command `composer require a/b`
- Load `vendor/autoload.php` file in your PHP code
- Use `a/b` library in your PHP code

---
# Using composer
- Login to a shell
- Install a package
    - `$ composer require a/b`
- Installing packages when `vendor/` is missing
    - `$ composer install`
    - Uses `composer.lock` to determine exact versions
- Updating packages regardless of what is in `vendor/`
    - `$ composer update`
    - Uses `composer.json` to determine non-exact versions

---
class: center, middle
# Example: GitHub repos

---
# Example: GitHub repos
- Yireo module `mod_github_repos`
    - https://github.com/yireo/mod_github_repos
- Shows a listing of GitHub repos on your frontend
- GitHub has an API to fetch data
- There is a composer package to make this easier
    - `knplabs/github-api`

---
# Steps to get things working
- Run `composer require knplabs/github-api`
- Run `composer require php-http/guzzle6-adapter`
- Create XML file `mod_github_repos.xml`
- Create PHP file `mod_github_repos.php`
- Create PHP file `helper.php`
    - Add `require_once JPATH_ROOT.'/vendor/autoload.php';`
    - Use library as documented

---
# Usage of GitHub library
As documented:
```php
require_once __DIR__ . '/vendor/autoload.php';
$client = new \Github\Client();
$repositories = $client->api('user')->repositories('ornicar');
```

In Joomla:
```php
require_once JPATH_ROOT . '/vendor/autoload.php';
$client = new \Github\Client();
$repositories = $client->api('user')->repositories('ornicar');
```

See: https://packagist.org/packages/knplabs/github-api

---
# File composer.json
```json
{
  "name": "yireo/joomla-github-repos",
  "license": "OSL-3.0",
  "type": "joomlatools-composer",
  "version": "2.0.1",
  "homepage": "https://github.com/yireo/mod_github_repos",
  "description": "",
  "keywords":[ "composer-installer", "joomla"],
  "authors": [{"name": "Jisse Reitsma","email": "jisse@yireo.com"}],
  "require": {
    "joomlatools/composer": "*",
    "knplabs/github-api": "*",
    "php-http/guzzle6-adapter": "*",
    "php": ">=7.0.0"
  }
}

```

---
class: center, middle
# Thoughts

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
