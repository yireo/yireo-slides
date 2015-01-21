class: center, middle
# Magento XML
### MUG &prime;s Hertogenbosch

---
# Magento XML
XML types
* Configuration
* Layout

---
# XML global files
* app/etc/config.xml
* app/etc/local.xml
* app/etc/modules/*.xml
* Module files

---
# Module files
app/code/{POOL}/{VENDOR}/{MODULE}/etc/

* config.xml
* system.xml
* adminhtml.xml

---
# Configuration XML
Definitions:
* Modules
* Object shortcuts
	* Blocks
	* Models
* Observers & events
* Routes (so controllers)
* Layout files
* Object shortcuts overrides

---
# Custom admin theme
```xml
<config>
  <stores>
    <admin>
      <design>
        <package>
          <name>default</name>
        </package>
        <theme>
          <default>mytheme</default>
        </theme>
      </design>
    </admin>
  </stores>
</config>
```

---
# Fall back themes
app/design/frontend/mypackage/default/etc/theme.xml
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
# Skip auto updates
```xml
<config>
  <global>
    <skip_process_modules_updates>1</skip_process_modules_updates>
  </global>
</config>
```
