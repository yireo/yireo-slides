layout: true
<div class="slide-heading">M2 Linking JS Components</div>
<div class="slide-footer">
    <span>M2 Linking JS Components - Jisse Reitsma - Meet Magento PL 2017</span>
</div>

---
class: center, middle, krakow, bgimage
# Magento 2
## Linking JS Components

Meet Magento Poland 2017

---
class: center, middle
### This slide is made possible with RemarkJS

???
Reminder: Make a silly joke on that this slide is using RemarkJS and refer to these student notes as an example.

---
class: center, middle
### This slide is also made possible with RemarkJS

---
class: orange
# About me
- Jisse Reitsma
--

- Founder and lead developer of Yireo
--

- Trainer, enterpreneur, coder
--

- Magento 2 Master "Mover" (2017)
--

- Knockout JiSse (I don't why)
--

- Loving Magento 2

---
# My talk
- JS Components
    - RequireJS
    - KnockoutJS
--
- Linking Components
    - imports
    - exports
    - links
--
- Personal opinion on this

---
class: center, middle
## Sample module
### [yireo-training/magento2-example-component-linking](https://github.com/yireo-training/magento2-example-component-linking)

---
# Sample module
- `etc/module.xml`
- `registration.php`
- `view/frontend/layout/default.xml`
- `view/frontend/templates/component1.phtml`
- `view/frontend/templates/component2.phtml`
- `view/frontend/requirejs-config.js`
- `view/frontend/web/js/component1.js`
- `view/frontend/web/js/component2.js`

---
# XML layout
File `view/frontend/layout/default.xml`:
```xml
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceContainer name="content">
        </referenceContainer>
    </body>
</page>
```
---
# XML layout
File `view/frontend/layout/default.xml`:
```xml
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceContainer name="content">
            <block class="Magento\Framework\View\Element\Template" name="component1" template="Yireo_ExampleComponentLinking::component1.phtml"/>
        </referenceContainer>
    </body>
</page>
```
---
# XML layout
File `view/frontend/layout/default.xml`:
```xml
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceContainer name="content">
            <block class="Magento\Framework\View\Element\Template" name="component1" template="Yireo_ExampleComponentLinking::component1.phtml"/>
            <block class="Magento\Framework\View\Element\Template" name="component2" template="Yireo_ExampleComponentLinking::component2.phtml"/>
        </referenceContainer>
    </body>
</page>
```

---
# PHTML template
File `view/frontend/templates/component2.phtml`:
```php
<div id="example-component-2" data-bind="scope: 'component2'"/>
```
--
```php
<script type="text/x-magento-init">
{
    "#example-component-2": {
        "Magento_Ui/js/core/app": {
            "components": {
                "component2": {
                    "component": "component2"
                }
            }
        }
    }
}
</script>
```

???
Linking only works if both components are delivering ViewModels that are registered in the uiRegistry.

---
# PHTML template
File `view/frontend/templates/component1.phtml`:
```php
<div id="example-component-1" data-bind="scope: 'component1'">
    <span data-bind="text: message">Waiting</span>
</div>
```
--
```php
<script type="text/x-magento-init">
{
    "#example-component-1": {
        "Magento_Ui/js/core/app": {
            "components": {
                "component1": {
                    "component": "component1",
                    "provider": "component2"
                }
            }
        }
    }
}
</script>
```

---
# RequireJS configuration
File `view/frontend/requirejs-config.js`:
```js
var config = {
    paths: {
        component1: 'Yireo_ExampleComponentLinking/js/component1',
        component2: 'Yireo_ExampleComponentLinking/js/component2'
    }
};
```

---
# Draft of component2
File `view/frontend/web/js/component2.js`:
```js
define(['uiComponent'],
    function (Component) {
        'use strict';
        return Component.extend({
            // @todo
        });
    }
);
```

---
# Draft of component1
File `view/frontend/web/js/component1.js`:
```js
define(['uiComponent'],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                message: 'Hello World'
            }
        });
    }
);
```

---
class: center, middle
<img class="img-responsive" src="../slides/yireo/images/m2_linking-components-01.jpg" />

---
# What happened

--
- XML layout and PHTML are used to create placeholders

--
- `x-magento-init` is used to initialize JS components

--
- `component1` delivers output through KnockoutJS

--
- `component2` is not doing anything yet

---
class: center, middle
### Exporting and importing

---
# Export from component2
File `view/frontend/web/js/component2.js`:
```js
define(['uiComponent'],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                message: 'Hello from component 2',
                exports: {
                    message: 'component1:message'
                }
            }
        });
    }
);
```

---
class: center, middle
<img class="img-responsive" src="../slides/yireo/images/m2_linking-components-02.jpg" />

---
# Plain component2
File `view/frontend/web/js/component2.js`:
```js
define(['uiComponent'],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                message: 'Hello from component 2'
            }
        });
    }
);
```

---
# Imports from component2
File `view/frontend/web/js/component1.js`:
```js
define(['uiComponent'],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                message: 'Hello World',
                imports: {
                    message: 'component2:message'
                }
            }
        });
    }
);
```

???
For this to work, `component2` needs to be loaded earlier in the DOM than `component2`.

---
class: center, middle
### Providers

---
# Remember the PHTML
File `view/frontend/templates/component1.phtml`:
```php
<script type="text/x-magento-init">
{
    "#example-component-1": {
        "Magento_Ui/js/core/app": {
            "components": {
                "component1": {
                    "component": "component1",
                    "provider": "component2"
                }
            }
        }
    }
}
</script>
```

---
# Internal property
File `view/frontend/web/js/component1.js`:
```js
define(['uiComponent'],
    function (Component) {
        'use strict';
        return Component.extend({
            initialize: function() {
                this._super();
                console.log('Provider: ' + this.provider);
                return true;
            }
        });
    }
);
```

---
# Template literals
File `view/frontend/web/js/component1.js`:
```js
define(['uiComponent'],
    function (Component) {
        'use strict';
        return Component.extend({
            defaults: {
                message: 'Hello World',
                imports: {
                    message: '${ $.provider }:message'
                }
            }
        });
    }
);
```

---
class: center, middle
### What are we doing?

---
# Ingredients

--
- RequireJS for dependency management

--
- KnockoutJS for managing ViewModels

--
- uiRegistry keeping track of ViewModels

--
- Imports/exports allowing to connect everything


--
### But is this all ok?

---
class: center, middle
<img class="img-responsive" src="../slides/yireo/images/complex-diagram.jpg" />

---
# Clean code

--
- Design patterns

--
- Composition over inheritance

--
- Link components, not component properties

---
class: center, middle
<img class="img-responsive" src="../slides/yireo/images/jisse-frown.jpg" />

---
# Manually using uiRegistry
File `view/frontend/web/js/component1.js`:
```js
define(['uiComponent', 'uiRegistry'],
    function (Component, uiRegistry) {
        'use strict';
        return Component.extend({
            defaults: {
                message: 'Hello from component 1'
            },
            initialize: function() {
                this._super();
                this.providerObject = uiRegistry.get('component2');
                this.message = this.providerObject.message;
                return this;
            }
        });
    }
);
```

---
# Manually using DI
File `view/frontend/web/js/component1.js`:
```js
define(['uiComponent', 'component2'],
    function (Component, component2) {
        'use strict';
        var component2 = component2();
        return Component.extend({
            defaults: {
                message: 'Hello from component 1'
            },
            initialize: function() {
                this._super();
                this.message = component2.message;
                return this;
            }
        });
    }
);
```

---
# My advice

--
- Prefer DI over linking

--
- Keep reading on JavaScript

--
- Focus on JS testing

---
class: center, middle
### Before I stop talking

---
class: orange, center, middle
<h1 class="magetestfest"><span>Mage</span><span>Test</span><span>Fest</span></h1>

---
<h1 class="magetestfest">Mage Test Fest</h1>

--
- Magento. Software Testing. Party.

--
- November 15th-18th 2017

--
- Prodent Factory, Amersfoort, The Netherlands

--
- 7 awesome speakers

--
- [magetestfest.com](https://magetestfest.com/)

---
class: center, middle, world
# Any questions?
### @yireo
### @jissereitsma

