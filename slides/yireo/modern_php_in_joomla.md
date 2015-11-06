layout: true
<div class="slide-heading">Mddern PHP mixed in Joomla</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com</span>
</div>

---
class: center, middle
# Modern PHP mixed in Joomla
### modern-day OOP practices for Joomla

---
class: center, middle
# http://slides.yireo.com/

---
# Jisse Reitsma
- Founder of Yireo
- Author of "Programming Joomla Plugins"
    - Missing guide for plugins
    - For both beginner and experienced developer
    - Available as dead-tree-format (ebook end of November 2015)
- Part of Zend Z-Team
    - Zend Server Z-Ray plugin for Joomla
    - Various Zend tutorials

---
# Yireo Education
* Physical events
    - Joomla Development Crash Course (me)
    - Dutch Joomla PHP Developers (Roland Dalmulder)
    - Expert Sessie (Sander Potjer)
* Online events
    - 80+ Tutorials
    - Programming Joomla Modules video-course
    
https://www.yireo.com/education/joomla-education

---
# This presentation
- Interfaces & abstract classes
- Exceptions
- Namespaces
- Closures & lambdas & anonymous functions
- Mixins & traits
- PHP 7

---
class: center, middle
# Interfaces & abstract classes

---
# Inheritance
```php
class JModelList
{
    public function getState() { ... }
    public function getItems() { ... }
}

class ExampleModelItems extends JModelLegacy
{
    public function getItems() { ... }
}

$model = new ExampleModelItems;
$items = $model->getItems();
$limit = $model->getState('limit');
```

---
# Abstract classes
```php
abstract class JModelForm
{
    public function getState() { ... }
    abstract public function getForm();
}

class ExampleModelItem extends JModelForm
{
    public function load($id) { ... }
    public function getForm() { ... }
}
```

---
# Interfaces
```php
interface JModel
{
    public function getState();
    public function setState(Registry $state);
}

class JModelbase implements JModel
{
    public function getState() { ... }
    public function setState(Registry $state) { ... }
}
```

---
# Recommendations
- Implement `JModel` in all your models
- Extend from whatever you feel comfortable with
	- `JModelLegacy`, `JModelItem`, `JModelForm`
	- `JModelBase`
- Create your own contracts (so: interfaces)

```
ExampleModelItem extends JModelForm implements JModel implements ExampleModelContract
```

---
class: center, middle
# Exceptions

---
# Exceptions
- Usage
    - Defining the exception with `throw`
    - Catching the exception with `try {} catch(Exception $e) {}`

---
# Defining the exception
```php
class Log
{
    static public function write($string)
    {
        if (!is_writable($this->logfile))
        {
            throw new Exception('Unable to write to log');
        }
        ...
    }
}
```

---
# Catching the exception
```php
try
{
    Log::write('Hello World');
}
catch(Exception $e)
{
    echo 'Caught exception: '.$e->getMessage();
}
```

---
# PHP native exceptions
* `BadMethodCallException`
* `InvalidArgumentException`
* `LengthException`
* `OutOfBoundsException`
* `RuntimeException`
* `UnexpectedValueException`
* ...

---
# Recommendations
- Do not return errors, instead throw exceptions
- Create your own exception classes

---
class: center, middle
# Namespaces

---
# Namespace definition
File `libraries/yireo/joomla/dynamic404/helpers/matching.php`:
```php
namespace Yireo\Joomla\Dynamic404\Helpers;

class Matching
{
    static public function match($search) {}
}
```

---
# Namespace usage
```php
$matches = \Yireo\Joomla\Dynamic404\Helpers\Matching::match($search);
```

```php
use Yireo\Joomla\Dynamic404 as Dynamic404;
$matches = Dynamic404\Helpers\Matching::match($search);
```

---
# Rewrite legacy to namespaces
@todo
- `JRegistry` > `\Joomla\Registry'

---
class: center, middle
# closures & lambdas & anonymous functions
@todo

---
class: center, middle
# Mixings & traits

---
# Mixins
@todo

---
# Traits
@todo

---
class: center, middle
# more stuff
- PHP 7
- Unit testing
- Reflection API
- Design patterns
- PSR standards

---
class: center, middle
## thanks
### tweet me via @yireo