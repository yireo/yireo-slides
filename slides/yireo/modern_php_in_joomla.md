layout: true
<div class="slide-heading">Modern PHP mixed in Joomla</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com  - #jab16 - @yireo / @jissereitsma</span>
</div>

---
class: center, middle
# Modern PHP in Joomla
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
- Part of Zend Z-Team
    - Zend Server Z-Ray plugin for Joomla
    - Various Zend tutorials

---
# Yireo Education
- Joomla Development Crash Course
- PHP Advanced Training
- Magento 2 Development
- Dutch Joomla Developers (Roland & Pe7er)
- Expert Sessie (Sander)
- 80+ Online Tutorials
 
https://www.yireo.com/education/joomla-education

---
# This presentation
- Interfaces & abstract classes
- Exceptions
- Namespaces
- Mixins & traits

---
# Modern PHP
- "Modern PHP" by Josh Lockhart
- PHP 7
- http://www.phptherightway.com/

---
class: center, middle
# Interfaces 
# & abstract classes

---
# Inheritance (1 of 2)
```php
class JModelList
{
    public function getState() { ... }
    public function getItems() { ... }
}

class ExampleModelItems extends JModelList
{
    public function getItems() { ... }
}

$model = new ExampleModelItems;
$items = $model->getItems();
$limit = $model->getState('limit');
```

---
# Inheritance (2 of 2)
```php
class YireoModelList extends JModelLegacy
{
    public function getState() { ... }
    public function getData() { ... }
}

class ExampleModelItems extends YireoModelList
{
    public function getData() { ... }
}

$model = new ExampleModelItems;
$items = $model->getData();
$limit = $model->getState('limit');
```

---
# Problem of inheritance
- Hierarchy of classes quickly becomes complex
- No guarantee that subclass properly uses code offered by parent

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
# Abstract vs interfaces
- Interfaces offer clean way for contracting
- Abstract classes are a half-breed
- Use interfaces instead of abstract classes

---
# Towards interface (1 of 3)
```php
// Already in Joomla core
abstract class JModelForm
{
    public function getState() { ... }
    public function setState() { ... }
    abstract public function getForm();
}

// My class dummy
class ExampleModelItem extends JModelForm
{
    public function load($id) { ... }
    public function getForm() { ... }
}
```

---
# Towards interface (2 of 3)
```php
// Already in Joomla core
interface JModel
{
    public function getState();
    public function setState();
}

// New
interface ExampleModelFormContract
{
    public function getForm();
}
```

---
# Towards interface (3 of 3)
```php
// Already in Joomla core
abstract class JModelForm
{
    public function getState() { ... }
    public function setState() { ... }
    abstract public function getForm();
}

// My class dummy
class ExampleModelItem extends JModelForm
    implements ExampleModelFormContract, JModel
{
    public function load($id) { ... }
    public function getForm() { ... }
}
```

---
# Recommendations
- Implement `JModel` interface in all your models
- Extend from whatever you feel comfortable with
	- `JModelLegacy`, `JModelItem`, `JModelForm`
	- `JModelBase`
- Create your own contracts (so: interfaces)

```php
class ExampleModelItem extends JModelForm 
    implements JModel, ExampleModelContract
```

---
class: center, middle
# Exceptions

---
# Exceptions: Usage
- Defining the exception
    - `throw new Exception($errorMsg);`
- Catching the exception
    - `try {} catch(Exception $e) {}`

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
    - `ComponentNotFoundException`
    - `ComponentViewNotFoundException`
    - `AccessNotAllowedException`
    - `PluginNotEnabledException`

---
# Custom exception (1 of 2)
```php
class ExampleException extends Exception
{
}
```

---
# Custom exception (2 of 2)
```php
class ExampleException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null) {
        $message = '[ExampleException] ' . $message;
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

throw ExampleException('test');

try { something(); } catch(ExampleException $e) {
    echo $e;
}
```

---
class: center, middle
# Namespaces

---
# Namespace definition
File `libraries > Yireo > Joomla > Dynamic404 > Helpers > Matching.php`:
```php
namespace Yireo\Joomla\Dynamic404\Helpers;

class Matching
{
    public function match($search) {}
}
```

---
# Namespace usage
Full namespace:
```php
$matchHelper = new \Yireo\Joomla\Dynamic404\Helpers\Matching;
```

With a namespace alias:
```php
use Yireo\Joomla\Dynamic404\Helpers\Matching as Dynamic404Matching;
$matchHelper = new Dynamic404Matching;
```

Or aliasing part of the full namespace:
```php
use Yireo\Joomla\Dynamic404 as Dynamic404;
$matchHelper = Dynamic404\Helpers\Matching;
```

---
# Legacy to namespaces
- `JRegistry` > `\Joomla\Registry`
- `JArrayHelper` > `\Joomla\Utilities\ArrayHelper`
- `JURI` extends `Joomla\Uri\Uri`

---
# Recommendations
- Try to convert your own code to namespaces
    - Helper classes
    - Library classes
    - Interfaces

---
class: center, middle
# Mixins & traits

---
# Problem of inheritance
- Multiple inheritance is not possible
- Code clutters in either subclass or parent classes
- Possible solution
    - Mixins
    - Traits

---
# Mixins
- Override `__call` magic function
- Search for right method automatically
- Include methods from other classes
- Determined at runtime

---
# Mixins (1 of 2)
```php
class SubExample extends ParentExample
{
    protected $mixins = array('Alertable');
}

$example = new SubExample;
$example->alert('Hello World');
```

---
# Mixins (2 of 2)
```php
class ParentExample
{
    public function __call($method, $arguments)
    {
        if ($method == 'alert')
        {
            $alertable = new Alertable;
            $alertable->alert($arguments);
        }
    }
}

class Alertable
{
    public function alert($string)
    {
        echo '<script>alert("'.$string.'");</script>';
    }
}
```

---
# Traits (1 of 2)
```php
class SubExample extends ParentExample
{
}

$example = new SubExample;
$example->alert('Hello World');
```

---
# Traits (2 of 2)
```php
class ParentExample
{
    use Alertable;
}

trait Alertable
{
    public function alert($string)
    {
        echo '<script>alert("'.$string.'");</script>';
    }
}
```

---
# Traits
- PHP 5.4 or later
- New `use` call within class definition
- Include methods from `trait` not `class` classes
- Determined at code time

---
# Recommendations
- Use traits or mixins for:
    - Behavioral patterns
- Name methods properly
    - Similar name to trait or mixins
    - trait `Alterable`: `alert`
    - mixin `Publishable`: `publish` / `unpublish`
- Or use Composition to solve things instead

---
# more stuff
- Dependency Injection
- Unit testing / Reflection API
- Design patterns
- PSR standards

---
class: center, middle
## thanks
### tweet me via @yireo
