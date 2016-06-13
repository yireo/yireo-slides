class: center, middle
# Magento Composer
### MUG &prime;s Hertogenbosch

---
# Composer
* Satis
* Tips

---
# Basis
* Git, GitHub, repositories, commits
* Derde partij PHP libraries

---
# Composer
* Dependency Manager for PHP
* Gemakkelijk packages downloaden
    * `composer install` / `composer update`
* Package aanbieden
    * Via ZIP (distribution type `zip`)
    * Via VCS (git, Subversion, Mercurial)

---
# Stappen composer
* Installeer composer
    * `curl -sS https://getcomposer.org/installer | php`
    * `sudo cp composer.phar /usr/local/bin/composer`
* Definieer eigen `composer.json` file
    * Voeg PHP libraries die je nodig hebt toe
* Draai composer
    * `composer install`
    * `composer update`
* Nieuwe libraries toevoegen aan project
    * `require 'vendor/autoload.php';`

---
# Installatie Magento 2
```bash
$ git clone git@github.com:magento/magento2.git
$ cd magento2 && composer install
```

http://magenticians.com/installing-magento-2-composer

---
# Installatie Magento 1 exts
* Mogelijk via custom composer installer voor magento
* GitHub: [magento-hackathon/magento-composer-installer](https://github.com/magento-hackathon/magento-composer-installer)

---
# Repositories toevoegen
* Repository aanmelden bij Packagist
* Aanhaken bij Magento Hackathon composer repository:
    * GitHub: [magento-hackathon/composer-repository](https://github.com/magento-hackathon/composer-repository)
    * Aanpassen `satis.json`
    * Wachten op acceptatie van pull request
* Zelf een eigen Satis server definieren
    * Mogelijkheid van private repositories

---
# Composer repositories
* Packagist
* Satis
* Toran Proxy (commercieel Satis alternatief)

---
# composer.json voor Satis
```json
{
    "repositories": [
        {"type": "composer", "url": "http://satis.yireo.com"}
    ],
    "require": {
        "yireo/yireo_checkout-tester": "*"
    }
}
```

---
# satis.json
```json
{
 "name": "Yireo",
 "homepage": "http://satis.yireo.com",
 "description": "Visit https://github.com/yireo/Yireo_Satis",
 "repositories": [
  {"type":"vcs","url":"git://github.com/yireo/Yireo_DisableLog"},
  {"type":"vcs","url":"git://github.com/yireo/Yireo_NewRelic"},
  {"type":"vcs","url":"git://github.com/yireo/Yireo_SystemInfo"},
  {"type":"vcs","url":"git://github.com/yireo/Yireo_WebP"},
 ],
 "require-all": true
}

```
---
# Satis aanpassen
* `satis.json` updaten
* `$ satis build satis.json .`

---
# Composer lock file
* File `composer.lock` 
* Bevat precieze installatie gegevens (versies)
* Toevoegen aan Git repository of niet?
    * Bij open source project: Nee?
    * Bij maatwerk project: Ja?

---
# --no-dev vlag
* Voorbeeld: `composer install --no-dev`
* Slaat pakketjes met `require-dev` over
    * Bijvoorbeeld: `monolog`, PHP Unit

---
# Veel pakketjes
* Documentatie van waarom welke libraries
* Optimaliseer autoloader:
    * `composer dump-autoload --optimize`

---
class: center, middle
### done
