class: center, middle
# Composer
### Dutch Joomla PHP Developers

---
# Basics
GetComposer.org

```
composer require phpmd/phpmd
composer require raveren/kint
composer create-project laravel/laravel
```

---
# Composer autoload
```php
require_once 'vendor/autoload.php';

Kint::debug($_POST);
```

---
# Autoloaders
- PSR autoloading
    - Uses namespaces to map classes
    - `Yireo\Foo\Bar` in file `Yireo/Foo/Bar.php`
- Composer autoloader
    - Implements PSR standard
- Custom autoloaders

---
# Yireo Autoloader (1 of 2)
```php
\Yireo\Common\System\Autoloader::init();
\Yireo\Common\System\Autoloader::addPath(__DIR__.'/../lib/Yireo');
```

---
# Yireo Autoloader (2 of 2)
```php
namespace Yireo\Common\System;
class Autoloader
{
    public function __construct()
    {
        self::$paths[] = dirname(__DIR__) . '/';
    }

    static public function init()
    {
        spl_autoload_register(array(new self, 'load'));
    }
}
```

---
# Composer tips
- Install Prestissimo

--
- Optimize autoload file
    - `composer dump-autoload --optimize`
--
- Create small composer packages for whatever

---
# Repository sources
- Packagist
- Private Packagist
- Satis
- ToranProxy

---
# Satis mirroring (1/3)
Satis setup: 

	git clone https://github.com/composer/satis
	cd satis/
	composer install

---
# Satis mirroring (2/3)
File `satis.json`:
```json
{
    "homepage": "https://my-mirror.yireo.com",
    "repositories": [
        {
            "type": "composer",
            "url": "https://repo.magento.com"
        }
    ],
    "require-dependencies": true,
    "require-dev-dependencies": true,
    "require-all": true,
    "archive": {
        "directory": "dist",
        "format": "zip",
        "prefix-url": "https://my-mirror.yireo.com",
        "skip-dev": false
    }
}
```

---
# Satis mirroring (3/3)
Building Satis:

	php -d memory_limit=1G satis/bin/satis build satis.json public

Example: https://satis.yireo.com/

---
# Fixing other repos
- Clone repository
- Optionally change composer `name`
- Use own repository
    - Until PR is merged
    - Forever

---
# Versioning
- git tagging
- Composer version
- Semantic versioning
- Version matching: `.*`, `~1`, `dev-master`

---
# Install vs update
- Lock file holds exact versions
- `update` updates lock file
- `install` installs from lock file

---
# Working in vendor/
- Install package via composer and git+ssh
- Directly work in `vendor/xyz`
    - Make sure to commit your changes
- `composer status` to check for manual changes
- Use up-to-date composer version

---
# Composer in Joomla
- `/libraries/vendor` folder (core)
- `/vendor` folder (your own stuff)
- Any `vendor` folder in Joomla extensions

---
# vendor/ in extensions
Regular Labs Sourcerer `composer.json`:
```php
{
    "autoload": {
        "psr-4": {
            "RegularLabs\\Sourcerer\\": "src/"
        }
    }
}
```

Just for autoloading namespaced classes.

---
# Joomla recommendations
- None

---
class: center, middle
### The End

