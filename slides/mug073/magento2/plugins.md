class: center, middle
# Plugins and AOP

---
# Pieces
- Yireo Magento 2 Development Training
- Magento 2 Seminar (October 21st 2016)
- Daniel Sloofs work on AOP for Magento 1

---
# AOP
- Aspect Oriented Programming
- Cleanly insert custom code in aspects of original code
- Other similar methods
    - Dependency Injection with preferences and types
    - Observer / events

---
# Plugins
- Allows for modifying object methods
- Does not work with:
    + Final classes
    + Methods that are protected, private or final
    + Classes created without DI (non-injectable)
- Interceptor class is generated as a result
    + Combines original class methods plus plugin methods

---
# Declaring a plugin
File `etc/di.xml`:
```xml
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
    xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <type name="Magento\Catalog\Api\Product">
        <plugin name="uniqueFoobarName"
            type="Yireo\FooBar\Plugin\Catalog\Product" 
            sortOrder="1" disabled="false"/>
    </type>
</config>
```
Ordering is possible via `sortOrder`, which might be great (or not).

---
# Plugin method
- beforeMETHOD
- afterMETHOD
- aroundMETHOD

---
# Using a plugin (before)
```php
namespace Yireo\FooBar\Plugin;
use Magento\Catalog\Model\Product as ProductSubject;
class Product
{
    public function beforeSetName(ProductSubject $subject, $name)
    {
        $name = 'Example: ' . $name;
        return array($name);
    }
}
```
The first argument `$subject` is specific to the plugin method. The other method arguments are copies of the original method arguments, and they need to be part of a return array - modified or not. If there is only 1 original method argument, the return value can be a single value, instead of an array.

---
# Using a plugin (after)
```php
namespace Yireo\FooBar\Plugin;
use Magento\Catalog\Model\Product as ProductSubject;
class Product
{
    public function afterSetName(ProductSubject $subject, $name)
    {
        $name = 'Example: ' . $name;
        return $name;
    }
}
```
Same principle applies, except that the return value of the original method is modified instead. Make sure to return something of the same type.

---
# Using a plugin (around)
```php
namespace Yireo\FooBar\Plugin;
use Magento\Catalog\Model\Product as ProductSubject;
class Product
{
    public function aroundSetName(
        ProductSubject $subject,
        \Closure $proceed,
        $name
    )
    {
        $returnValue = $proceed($name);
        return $returnValue;
    }
}
```
Same principle applies, except that a closure `$proceed` is used to call upon the original method. This is almost similar to setting a preference, extending the new class from the original and only override a single method.

---
# Tips using plugins
- Don't confuse yourself too much with `aroundMETHOD`
    + Prefer `beforeMETHOD` and `afterMETHOD` instead
    + Or use observable events instead
    + Or use a preference instead
- `$subject` gives access to all public methods of original object

---
class: center, middle
# Conflicts?
