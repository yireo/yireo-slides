{state: main middle dark}
{background-image: apollo/bg-startrek.png}
# Creating supercharged Shopping Experiences in Shopware PWA

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of developers
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2)
~ Creator of Reacticon v3 (June 2021)
~ Magento Master 2017/2018/2019 Mover
~ Member of ExtDN (Magento Extension Developer Network)

---
{state: main middle dark}
{background-image: apollo/picard-laughing.gif}
# Some slogan

---
# Shopware 6 plugin (1/3)
- `composer.json`
- `src/SwagTrainingPwaCms.php`
- `src/Resources/config/services.xml`

---
# Shopware 6 plugin (2/3)
- `src/Resources/config/config.xml`
- `src/Config/Config.php`
-

---
# Shopware 6 plugin (3/3)

- `src/Resources/app/pwa/config.json`
- `src/Resources/app/pwa/account-cms-page.vue`

---
#

---
# Service declaration
- New service for `config`

^^See sources @todo

---
# Overriding `SwPersonalInfo`
```vue
<template>
  <div>
    <SwPluginSlot name="account-cms-page"/>
    <OriginalSwPersonalInfo />
  </div>
</template>

<script>
import OriginalSwPersonalInfo from "@theme/components/forms/SwPersonalInfo.vue";
import SwPluginSlot from "sw-plugins/SwPluginSlot.vue";

export default {
  name: "NewSwPersonalInfo",
  components: {
    OriginalSwPersonalInfo,
    SwPluginSlot
  }
}
</script>
```
