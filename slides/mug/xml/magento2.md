class: center, middle
# Magento 2 XML changes
### MUG &prime;s Hertogenbosch

---
# Module path changes
Base layout file
`app/code/Yireo/Dummy/view/frontend/layout/dummy.xml`

Theme layout file
`app/design/frontend/custom/Yireo_Dummy/layout/dummy.xml`

---
# Defining a block
```xml
<block class="Yireo_Dummy_Block_Foobar" name="foobar">
  ...
</block>
```

```xml
<block class="Yireo\Dummy\Block\Foobar" name="foobar">
  ...
</block>
```

---
# Moving a block
```xml
<move element="child.a" destination="parent.x" before="child.b" />
```

---
# Containers
Formerly blocks of type `core/text_list`

```xml
<container name="box1">
</container>
```

Attributes:
* htmlTag = "div"
* htmlId = "box1"
* htmlClass = "container"
* no template

---
# Layout handles
Layout filename determines actual layout handle:
`dummy.xml`

```xml
<dummy>
    ...
</dummy>
```

---
# Other changes
* `<reference>` is now `<referenceBlock>` or `<referenceContainer>`
* `<action>` calls now have `<argument>` variables
* Practice to add `xsi:type="string"` attribute to arguments

https://wiki.magento.com/display/MAGE2DOC/XML+Instructions
