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
# Let's build a simple Shopware 6 plugin

---
# Shopware 6 plugin (1/3)
- `composer.json`
- `src/SwagTrainingPwaCms.php`
- `src/Resources/config/services.xml`


---
{state: main middle dark}
{background-image: apollo/picard-laughing.gif}
# Let's add a plugin configuration that is added to the JSON output of `GET store-api/context` (with valid access token)

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

    public function __construct(SystemConfigService $systemConfigService) {
        $config = $systemConfigService->get('SwagTrainingPwaCms');
        $this->cmsPageUuid = $config['config']['cmsPageUuid'];
    }

    public function getCmsPageUuid(): string
    {
        return $this->cmsPageUuid;
    }
}
```

^^Note that `$cmsPageUuid` is protected, not private

---
# Service declaration (1/2)
```xml
<?xml version="1.0" ?>
<container xmlns="http://symfony.com/schema/dic/services" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">
    <services>
        <service id="SwagTraining\PwaCms\Config\Config">
            <argument type="service" id="Shopware\Core\System\SystemConfig\SystemConfigService"/>
        </service>
    </services>
</container>
```

---
# Service declaration (2/2)
```xml
<?xml version="1.0" ?>
<container xmlns="http://symfony.com/schema/dic/services" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://symfony.com/schema/dic/services http://symfony.com/schema/dic/services/services-1.0.xsd">
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
# Service decorator (1/2)
```php
namespace SwagTraining\PwaCms\Decorator;

use Shopware\Core\System\SalesChannel\Context\AbstractSalesChannelContextFactory;
use Shopware\Core\System\SalesChannel\Context\SalesChannelContextFactory;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use SwagTraining\PwaCms\Config\Config;

class ExtendedSalesChannelContextFactory extends SalesChannelContextFactory
{
    private Config $config;
    private SalesChannelContextFactory $salesChannelContextFactory;

    public function __construct(
        SalesChannelContextFactory $salesChannelContextFactory,
        Config $config
    ) {
        $this->salesChannelContextFactory = $salesChannelContextFactory;
        $this->config = $config;
    }

    ...
}
```

---
# Service decorator (2/2)
```php
class ExtendedSalesChannelContextFactory extends SalesChannelContextFactory
{
    ...

    public function create(string $token, string $salesChannelId, array $options = []): SalesChannelContext
    {
        $salesChannelContext = $this->salesChannelContextFactory->create($token, $salesChannelId, $options);
        $salesChannelContext->addExtension('swagTrainingPwaCmsConfig', $this->config);
        return $salesChannelContext;
    }

    public function getDecorated(): AbstractSalesChannelContextFactory
    {
        return $this->salesChannelContextFactory;
    }
}
```

---
{state: main middle dark}
{background-image: apollo/picard-laughing.gif}
# Let's create a Vue component in the Shopware PWA, via this very same Shopware 6 plugin

---
# Shopware 6 plugin (3/3)
- `src/Resources/app/pwa/config.json`
- `src/Resources/app/pwa/account-cms-page.vue`

---
# Vue component (1/4)
```vue
<template>
  <div>
    <h3>Example CMS Page Content</h3>
    <CmsPage :content="cmsPage" />
  </div>
</template>
```

---
# Vue component (2/4)
```vue
<script>
import { useSessionContext } from "@shopware-pwa/composables"
import { getApplicationContext } from "@shopware-pwa/composables"
import { invokeGet } from "@shopware-pwa/shopware-6-client"
import { defineComponent, watch, onMounted, ref } from "@vue/composition-api"
import CmsPage from "sw-cms/CmsPage"
```

---
# Vue component (3/4)
```vue
const loadCmsPage = (root, sessionContext, cmsPage) => {
  const cmsPageId =
    sessionContext.value.extensions.swagTrainingPwaCmsConfig.cmsPageUuid
  try {
    const { apiInstance } = getApplicationContext(root, "SwagExample")

    invokeGet({ address: "/store-api/cms/" + cmsPageId }, apiInstance).then(
      (response) => {
        if (response.data) {
          cmsPage.value = response.data
          console.log(cmsPage)
        }
      }
    )
  } catch (error) {
    console.error("SwagExample:onMounted", error)
  }
}
```

---
# Vue component (4/4)
```vue
export default defineComponent({
  components: { CmsPage },
  setup(props, { root }) {
    const { sessionContext } = useSessionContext()
    const cmsPage = ref({})

    onMounted(async () => {
      if (sessionContext.value) {
        loadCmsPage(root, sessionContext, cmsPage)
      }
    })

    watch(sessionContext, (root, cmsPage) => {
      loadCmsPage(root, sessionContext, cmsPage)
    })

    return {
      cmsPage,
    }
  },
})
</script>
```

---
# `config.json`
```json
{
    "slots": [
        {
            "name": "account-cms-page",
            "file": "account-cms-page.vue"
        }
    ]
}
```

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
