class: center, middle
# Magento n98-Magerun
### MUG &prime;s Hertogenbosch

---
# n98-Magerun
* Command-line tool for managing Magento sites
* Links
    - https://github.com/netz98/n98-magerun
    - http://magerun.net/

---
# Placement
- SSH access
- Other CLI tools
    - git
    - modman / composer

---
# Installation
Installing:
```bash
github=https://raw.githubusercontent.com/netz98/
wget ${github}/n98-magerun/master/n98-magerun.phar
chmod +x ./n98-magerun.phar
sudo cp ./n98-magerun.phar /usr/local/bin/magerun
```

Updating:
```
sudo magerun self-update
```

---
# Common tasks (1)
System check:
```bash
magerun sys:check
magerun sys:info
magerun sys:modules:list
magerun extension:validate
```

Reindex specific indices:
```bash
magerun index:reindex catalog_product_attribute,tag_summary
```

Cache handling:
```bash
magerun cache:clean
magerun cache:flush
```

---
# Common tasks (2)
Upgrading extensions:
```bash
magerun extension:upgrade Foo_Bar
magerun extension:upgrade Mage_All
```

Checking for conflicts:
```bash
magerun dev:module:rewrite:conflicts
magerun dev:module:rewrite:list
```

Output:
```
│blocks
│adminhtml/sales_items_column_name
|Yireo_Custsize_Block_Rewrite_Adminhtml_Order_Item_Name,
│Yireo_Membership_Block_Rewrite_Adminhtml_Order_Item_Name
```

---
# Debugging URLs
```bash
magerun config:search url
magerun config:get web/secure/base_url
magerun config:set web/secure/base_url "https://MAGENTO/"
```

---
# Debugging cache
Inspect the cache:
```bash
magerun cache:report
```

View a specific cache-file
```bash
magerun cache:view CONFIG_GLOBAL_ADMIN
```

---
# Dummy data
- Install extensions (`magerun extension:install`
- Create new customers / dummy customers
- Create admin roles (Yireo)
- Create dummy orders
- Generate giftcards (`EE_GiftCardAccount`)

---
# Configuration file
YAML file
```bash
 ~/.n98-magerun.yaml
```

Why customize?
- Create aliases for commands you use often
- Add your own packages for `magerun install`
- Change core commands with your own command
- Detect Magento in a subfolder (`site` instead of `www`)

```yaml
commands:
    aliases:
      - "addme": "customer:create jisse@yireo.com password01 Jisse Reitsma"
```

---
# 3rd party modules
- https://github.com/netz98/n98-magerun/wiki/
    - Project Mess Detector
    - Create a magerun module
    - Database exports
- https://github.com/yireo/magerun-addons

---
# Create an extension
Directory
```bash
~/.n98-magerun/modules/{MODULE}
```

Files:
```bash
n98-magerun.yaml
src/{COMPANY}/{MODULE}/Command/{GROUP}/{SUBGROUP}/{TASK}Command.php
```

PHP code:
- Namespacing
- Usage of `Symfony\Component\Console` classes

---
# Tips
- Combine magerun with zsh autocompletion
- Toggle template hints, profiler
- Want to open up the db? Use `magerun mysql-client`
- Run `magerun shell`

---
class: center, middle
### don't forget your towel
