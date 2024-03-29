{state: main middle dark opacity}
{background-image: reacticon4/waterbears.jpg}
# Creating supercharged Shopping Experiences in Shopware PWA

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Creator of MageTestFest
~ Creator of Reacticon 1 to 4
~ Magento Master 2017/2018/2019 Mover
~ Trainer of developers in Magento and Shopware
~ Member of ExtDN (Magento Extension Developer Network)

---
# About this talk
Demonstrating flexibility of both Shopware PWA and Shopware CMS

---
# Meet Shopware 6 Shopping Experiences
- Also known as the Shopware "CMS", managed via Administration
- Modular approach
  - CMS pages, sections, blocks and elements
  - Fully extensible with 3rd party Shopware 6 plugins

---
# Meet Shopware PWA
- Also known as Vue Storefront 2, but tailored specifically for Shopware 6
- Modular approach
  - Vue components, Vue plugins, Nuxt plugins, Vue Storefront modules
  - And extensible with 3rd party Shopware 6 plugins

---
# Combining both
- Manage content via Shopping Experiences
- Expose content via Store API
- Load content via AJAX into PWA
- Display content in Vue with CMS components
- Rebuild the PWA (because of SSR)

---
{state: main middle dark opacity}
{background-image: reacticon4/octopus.jpg}
# Let's build a simple Shopware 6 plugin

---
# Shopware 6 plugin (1/3)
- `composer.json`
- `src/SwagTrainingPwaCms.php`
- `src/Resources/config/services.xml`

These files are skipped in the following slides


---
{state: main middle dark opacity}
{background-image: reacticon4/octopus2.jpg}
# Let's add a plugin configuration that is added to the JSON output of `GET store-api/context`

---
# About the Store API
- Acts as an API for headless setups, like with Shopware PWA
- Any client request requires an access token
- Endpoint `store-api/context` offers global information

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
# About `config.xml`
- Adjustable via Shopware 6 Administration
- Via `component`, you can reuse any global Vue components
  - Check Shopware API Stoplight for core components
  - Or build your own

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

    public function getCmsPageUuid(): string {
        return $this->cmsPageUuid;
    }
}
```

---
# About `Config` struct
- Any public getter exposes data
- Entities are often extensible via structs
- For instance, `SalesChannelContext` which is used in the GET request `store-api/context`

Note that `$cmsPageUuid` is protected, not private. Otherwise it is not properly picked up by the `Struct`.

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
        ...
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

    public function __construct(SalesChannelContextFactory $salesChannelContextFactory, Config $config) {
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
{state: main middle dark opacity}
{background-image: reacticon4/octopus3.jpg}
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

<script>
...
</script>
```

---
# Vue component (2/4)
```js
import { useSessionContext } from "@shopware-pwa/composables"
import { getApplicationContext } from "@shopware-pwa/composables"
import { invokeGet } from "@shopware-pwa/shopware-6-client"
import { defineComponent, watch, onMounted, ref } from "@vue/composition-api"
import CmsPage from "sw-cms/CmsPage"
```

---
# Vue component (3/4)
```js
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
```js
export default defineComponent({
  components: { CmsPage },
  setup(props, { root }) {
    const { sessionContext } = useSessionContext()
    const cmsPage = ref({})

    onMounted(async () => {
      if (sessionContext.value) { loadCmsPage(root, sessionContext, cmsPage) }
    })

    watch(sessionContext, (root, cmsPage) => {
      loadCmsPage(root, sessionContext, cmsPage)
    })

    return { cmsPage }
  }
})
```

---
# About this Vue component
- Probably better to create custom Vue composable
- Perhaps this Vue composable `loadCmsPage` could be added to Shopware PWA

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

Note that this slot does not exist by default

---
# Overriding `SwPersonalInfo` (1/2)
```html
<template>
  <div>
    <SwPluginSlot name="account-cms-page"/>
    <OriginalSwPersonalInfo />
  </div>
</template>

<script>...</script>
```

---
# Overriding `SwPersonalInfo` (2/2)
```js
import OriginalSwPersonalInfo from "@theme/components/forms/SwPersonalInfo.vue";
import SwPluginSlot from "sw-plugins/SwPluginSlot.vue";

export default {
  name: "NewSwPersonalInfo",
  components: {
    OriginalSwPersonalInfo,
    SwPluginSlot
  }
}
```

---
# Conclusion
- Via new slots, we can extend the PWA via custom SW6 plugins
- Via SW6 plugins, you can unlock any content from Shopware 6
- Including the CMS

---
{state: main middle dark opacity}
{background-image: reacticon4/waterbears.jpg}
# Thanks
### [yireo-shopware6/swag-training-pwa-cms](https://github.com/yireo-shopware6/swag-training-pwa-cms)
