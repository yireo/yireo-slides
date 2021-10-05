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
- `src/Decorator/ExtendedSalesChannelContextFactory.php`

---
# `config.xml`
```xml
<?xml version="1.0" encoding="UTF-8"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="https://raw.githubusercontent.com/shopware/platform/master/src/Core/System/SystemConfig/Schema/config.xsd">
    <card>
        <title>SwagTrainingPwaCms Configuration</title>
        <component name="sw-entity-single-select">
            <name>cmsPageUuid</name>
            <label>CMS Page</label>
            <entity>cms_page</entity>
        </component>
    </card>
</config>
```

---
# `Config.php`
```php
namespace SwagTraining\PwaCms\Config;

use Shopware\Core\Framework\Struct\Struct;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class Config extends Struct
{
    protected string $cmsPageUuid = '';

    public function __construct(
        SystemConfigService $systemConfigService
    ) {
        $config = $systemConfigService->get('SwagTrainingPwaCms');
        $this->cmsPageUuid = $config['config']['cmsPageUuid'];
    }

    public function getCmsPageUuid(): string
    {
        return $this->cmsPageUuid;
    }
}
```

---
# Service declaration
```xml
<?xml version="1.0" ?>
<container xmlns="http://symfony.com/schema/dic/services"
           xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
           xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">
    <services>
      <service id="SwagTraining\PwaCms\Config\Config">
          <argument type="service" id="Shopware\Core\System\SystemConfig\SystemConfigService"/>
      </service>

        <service id="SwagTraining\PwaCms\Decorator\ExtendedSalesChannelContextFactory" decorates="Shopware\Core\System\SalesChannel\Context\SalesChannelContextFactory">
            <argument type="service" id=".inner"/>
            <argument type="service" id="SwagTraining\PwaCms\Config\Config"/>
        </service>
    </services>
</container>
```

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
