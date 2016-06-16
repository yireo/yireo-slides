layout: true
<div class="slide-heading">Magento User Group: XML and PHTML</div>
<div class="slide-footer">
    <span>Yireo - Magento trainingen</span>
</div>

---
class: center, middle
# XML and PHTML
### within Magento 1 and 2

---
# XML and PHTML
- XML types
    * Configuration
    * Layout
- PHTML
    * Templating

---
class: center, middle
# Configuration XML

---
# XML global files (m1)
* `app/etc/config.xml`
* `app/etc/local.xml`
* `app/etc/modules/*.xml`
* Module files

---
# XML global files (m2)
* (`config.xml` is substituted with `config.php`)
* (`local.xml` is substituted with `env.php`)
* (Modules are memorized by autoloader)
* `di.xml`
* Module files

---
# Module files (m1)
`app/code/POOL/VENDOR/MODULE/etc/`

* `config.xml`
* `system.xml`
* `adminhtml.xml`

---
# Module files (m2)
`app/code/VENDOR/MODULE/etc/` (legacy)
`vendor/VENDOR/MODULE/etc/` (composer)

* `config.xml`
* `adminhtml/system/.xml`

---
# Configuration XML
* Modules
* Object aliases (models, blocks, helpers)
* Observers & events
* Routes (so controllers)
* Layout files
* Object shortcuts overrides

---
# Custom admin theme (m1)
`app/etc/local.xml`
```xml
<config>
  <stores>
    <admin>
      <design>
        <package>
          <name>default</name>
        </package>
        <theme>
          <default>foo</default>
        </theme>
      </design>
    </admin>
  </stores>
</config>
```

---
# Fall back themes (m1)
`app/design/frontend/foo/default/etc/theme.xml`
```xml
<theme>
    <parent>default/modern</parent>
    <layout>
        <updates>
            <foobar>
                <file>updates/foobar.xml</file>
            </foobar>
        </updates>
    </layout>
</theme>
```

---
# Custom admin theme (m2)
`vendor/VENDOR/PACKAGE/etc/di.xml`
```xml
<type name="Magento\Theme\Model\View\Design">
    <arguments>
       <argument name="themes" xsi:type="array">
           <item name="adminhtml" xsi:type="string">
                VENDOR/PACKAGE
            </item>
       </argument>
    </arguments>
</type>
```

---
# Skip auto updates (m1)
`app/etc/local.xml`
```xml
<config>
  <global>
    <skip_process_modules_updates>1</skip_process_modules_updates>
  </global>
</config>
```

---
# Skip auto updates (m2)
There are no auto updates in m2

---
class: center, middle
# Layout XML

---
# Layout XML
Definitions:
* Blocks
* Handles
* Actions on blocks
* Updates

---
# Block flow
- XML Layout: definition of block
- Block class: the thing itself
- PHTML template: output of block (`$this`)

---
# Module path changes
m1:
`app/design/frontend/VENDOR/PACKAGE/layout/dummy.xml`

m2:
`app/code/VENDOR/PACKAGE/view/frontend/layout/dummy.xml`
`vendor/VENDOR/PACKAGE/view/frontend/layout/dummy.xml`

---
# Loading a block (m1)
```xml
<block type="core/template" name="foobar" template="foobar.phtml" />
```

* `type` = ref to `Mage_Core_Block_Template`
* `as` = custom alias
* `before` / `after` = alias of other block or `-`
* `template` = PHTML template 

---
# Loading a block (m2)
```xml
<block type="\Magento\Framework\View\Element\AbstractBlock" 
    name="foobar" template="foobar.phtml" />
```

* `type` = direct class name
* (no more class aliassing)
* `before` / `after` = `name` of other block or `-`
* `template` = PHTML template 

---
# Referencing a block (m1)
```xml
<reference name="root">
  <block type="core/template" name="foobar" />
</reference>

<reference name="foobar">
  <action method="setTemplate">
    <template>myfoobar.phtml</template>
  </action>
</reference>
```

---
# Referencing a block (m2)
```xml
<body>
  <block type="\Yireo\Foo\Block\Bar" name="foobar" />
</body>

<referenceBlock name="foobar">
  <action method="setTemplate">
    <template>myfoobar.phtml</template>
  </action>
</referenceBlock>

<referenceContainer name="left">
  <block type="\Yireo\Foo\Block\Bar" name="foobar" />
</referenceContainer>
```

---
# Adding CSS or JS (m1)
`app/design/frontend/VENDOR/PACKAGE/layout/default.xml`
```xml
<default>
  <reference name="head">
    <action method="addItem">
      <type>skin_css</type>
      <name>foobar/default.css</name>
    </action>
    <action method="addItem">
      <type>js</type>
      <name>foobar/default.js</name>
    </action>
  </reference>
</default>
```

---
# Adding CSS or JS (m2)
`vendor/VENDOR/PACKAGE/view/frontend/layout/default.xml`
```xml
<page>
    <head>
        <link src="foobar/default.js"/>
        <css src="foobar/default.css"/>
    </head>
</page>
```

---
# Containers (m2)
Formerly blocks of type `core/text_list`

```xml
<container name="box1">
</container>
```

* `htmlTag="div"`
* `htmlId="box1"`
* `htmlClass="container"`
* no template

---
# Other changes
* `<reference>` is now `<referenceBlock>` or `<referenceContainer>`
* `<action>` calls now have `<argument>` variables
* Practice to add `xsi:type="string"` attribute to arguments
* No `local.xml` theming file
* No more adding layout files to `etc/theme.xml`

https://wiki.magento.com/display/MAGE2DOC/XML+Instructions

---
# Tools
* Alan Storms CommerceBug
* AclReload
* AOE Layout Manager
* EcomDev LayoutCompiler

---
# Quiz
* Is block object loaded when XML defines it, but PHTML does not call upon it?

---
# Yireo training
- June 22nd - Magento 2 Developers Training
- July 8th - Magento 2 Theming Training
- July 22nd - Magento 2 Technical Merchant
- August 19th - PHP Advanced Training
- August 26th - Magento Performance Masterclass
- October 21st - Magento 2 Seminar
