class: center, middle
# Magento Layout XML
### MUG &prime;s Hertogenbosch

---
# Layout XML
Definitions:
* Blocks
* Handles
* Actions on blocks
* Updates

---
# Loading a block
```xml
<block type="core/template" name="foobar" template="foobar.phtml" />
```

---
# Block attributes
* type = core/template (Mage_Core_Block_Template)
* as = custom alias
* before / alias = alias or -
* template = PHTML template to override block default

---
# Referencing a block (1)
```xml
<reference name="root">
  <block type="core/template" name="foobar" template="foobar.phtml" />
</reference>
```

---
# Referencing a block (2)
```xml
<reference name="foobar">
  <action method="setTemplate">
    <template>myfoobar.phtml</template>
  </action>
</reference>
```

---
# Referencing a block (3)
```xml
<reference name="root">
  <remove name="foobar" />
</reference>
```

---
# Adding CSS or JS (1)
```xml
<default>
  <reference name="head">
    <action method="addItem">
      <type>skin_css</type>
      <name>css/foobar.css</name>
    </action>
    <action method="addItem">
      <type>js</type>
      <name>foobar/js</name>
    </action>
  </reference>
</default>
```

---
# Adding CSS or JS (2)
Methods of head block:
* addItem
* removeItem

Type parameter:
* js
* css
* skin_js
* skin_css

---
# Loading jQuery from Google CDN
```xml
<default>
  <reference name="head">
    <block type="core/text" name="google.cdn.jquery">
      <action method="setText">
        <text><![CDATA[
<script type="text/javascript" 
src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js">
</script>
<script type="text/javascript">jQuery.noConflict();</script>
        ]]>
        </text>
      </action>
    </block>
  </reference>
</default>
```

---
# Handles
```xml
<default>
  <block name="root">
    ..
  </block>  
</default>

<catalog_product_view>
  <block name="root">
    ..
  </block>  
</catalog_product_view>
```

---
# Update handles
Call one handle from within another handle:
```xml
<update name="foobar" /> 
```

---
# Inserting a handle
Observer method:
```php
$layout = Mage::app()->getLayout();
$layout->getUpdate()->addHandle('foobar');
```

XML layout:
```xml
<foobar>
</foobar>
```

---
# Using unsetChild
```xml
<default>
  <reference name="top.bar">
    <action method="unsetChild">
      <name>breadcrumbs</name>
    </action>
  </reference>

  <reference name="root">
    <block type="page/html_breadcrumbs" name="breadcrumbs" />
  </reference>
</default>
```

---
# PHP calls
```php
Mage::app()->getLayout()->getUpdate()->getHandles()
```

Events:
* controller_action_layout_generate_blocks_before

---
# Questions & tools
* Is block object loaded when XML defines it, but PHTML does not?

Useful tools
* Alan Storms CommerceBug
* AclReload
* AOE Layout Manager

