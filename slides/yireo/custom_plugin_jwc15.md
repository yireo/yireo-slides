layout: true
<div class="slide-heading">A System Plugin per project</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com - #jwc15</span>
</div>

---
class: center, middle
# Joomla Plugins
### a custom System Plugin per project

---
class: center, middle
# http://slides.yireo.com/

---
# Jisse Reitsma
- Founder of Yireo
    - 50% Joomla, 50% Magento
- Author of "Programming Joomla Plugins"
    - Missing guide for plugins
    - For both beginner and experienced developer
    - Dead-tree-format (ebook end of November 2015)
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
- About Plugins
- Practical scenarios
    - JForm forms
    - Reusing logic
- Sample Custom Plugin
    - Mixins
    - Traits

---
# Joomla Plugins
- Plugin Groups
- Events
- PHP code

---
# Extension types
- *Components* = main goal
- *Modules* = extra functionality
- *Plugins*
- *Templates* = webdesign
- *Libraries* = for developers

---
# Plugin definition
- Works in the "background"
- Tasks are processed via events
- Flexible but bit complex

---
# Plugin groups (1 of 2)
- *Content*
- *Authentication*
- *System*
- *User*
- *Search*
- *Smart Search* (`finder`)

---
# Plugin groups (2 of 2)
- *Captcha*
- *Two Factor Authentication*
- *Editor*
- *Button* (`editors-xtd`)
- *Quick Icons*

---
# Third party plugins
- E-commerce (payment, shipment)
    * Hikashop, RedShop, VirtueMart
- Content (additional fields, automatic content)
    * K2, ZOO, SimpleLists, Seblod
- Simply extendible
    * Kunena, Dynamic404, Akeeba Subscriptions

---
# Joomla Plugins
- Plugin Groups
    - Content
    - **System**
    - Authentication
- Plugin Events / Methods
    - `onContentPrepare`
    - `onAfterInitialise`
    - `onUserAuthenticate`
- Use System Plugins to fetch any event

---
# Events
- Technical way of hooking into something
- An event is triggered
    - By a component
    - By a module
- An event equals one or more methods in a plugin
    - `onContentDisplayBefore`
    - `onUserAuthenticate`

---
class: center, middle
# Code

---
# Content events
- `onContentSaveBefore`
- `onContentSaveAfter`
- `onContentDisplayBefore`

---
# User events
- `onUserBeforeSave`
- `onUserAfterSave`
- `onUserLogin`
- `onUserLogout`

---
# user/joomla folder
`plugins/user/joomla/`

* `joomla.php`
* `joomla.xml`
* `index.html`

---
# PHP intro in 30 seconds
* Programming language
* Object oriented programming
    * Objects are instances of classes
    * Classes have parts
        * Variables
        * Methods

---
# user/joomla plugin
```php
defined('_JEXEC') or die;

class PlgUserJoomla extends JPlugin
{
    protected $app;
    protected $db;

    public function onUserAfterDelete($user, $success, $msg) {}
    public function onUserAfterSave($user, $isnew, $success, $msg) {}

    public function onUserLogin($user, $options = array()) {}
    public function onUserLogout($user, $options = array()) {}

    protected function _getUser($user, $options = array())
}
```

---
# Plugin in PHP
* Plugin class extends of `JPlugin` class
* Events are fetched using method
    - I call these *event methods*
    - Access: `public`
* Extra code in other methods
    - I call these *helper methodes*
    - Access: `protected` of `private`

---
# Recaptcha folder
`plugins/captcha/recaptcha/`

* `recaptcha.php`
* `recaptcha.xml`
* `index.html`

---
# Recaptcha plugin
```php
defined('_JEXEC') or die;

class PlgCaptchaRecaptcha extends JPlugin
{
    public function onInit($id) {}
    public function onDisplay($name, $id, $class) {}
    public function onCheckAnswer($code) {}
    private function _recaptcha_qsencode($data) {}
}
```

---
# System events
- `onAfterInitialize`
- `onAfterRender`
- `onAfterDispatch`

---
# System Plugin skeleton
```php
defined('_JEXEC') or die;

class PlgSystemCustom extends JPlugin
{
    protected $app;
    protected $db;

    public function onAfterInitialise() {}
    public function onContentPrepare($context, &$row, $params, $page = 0) {}
    public function onUserAuthenticate($credentials, $options, &$response) {}

    protected function doSomethingGeneric() {}

    private function doSomethingVerySpecific() {}
}
```

---
# Plugin in PHP
* Plugin extends of `JPlugin` 
* Events are caught using methods
    - I call them *event methods*
    - Access: `public`
* Additional code in other methods
    - I call them *helper methods*
    - Access: `protected` or `private`

---
class: center, middle
# Modifying forms
### why we love JForm

---
# Why we love JForm
- Use a plugin to modify JForm objects
    - Modifying existing fields
    - Add new fields
- How
    - Define your own XML
    - Fuse this XML with the existing form
- Forms are everywhere

---
# XML file "form/form.xml"
```xml
&lt;?xml version="1.0" encoding="utf-8"?>
<form>
    <fields name="attribs">
        <fieldset name="attribs">
            <field name="test" type="text" 
                label="PLG_CONTENT_CH05TEST01_FIELD_TEST_LABEL" 
                description="PLG_CONTENT_CH05TEST01_FIELD_TEST_DESC" 
            />
        </fieldset>
    </fields>
</form>
```

---
# Add form

```php
public function onContentPrepareForm($form, $data)
{
    JForm::addFormPath(__DIR__ . '/form');
    $form->loadFile('form');
}
```

---
# Mental notes
- Method `onContentPrepareForm` is very generic

---
class: center, middle
# More stuff we can do
### with System Plugins

---
# Adding CSS

```php
public function onAfterInitialise()
{
    $cssFolder = 'media/plg_system_custom/css';

    $document = JFactory::getDocument();
    $document->addStylesheet($cssFolder . '/default.css');
}
```

---
# Clean code
* Methods should do only 1 thing
* Reduce dependancies of a single method

---
# Adding CSS and JS (+)

```php
public function onAfterInitialise()
{
    $this->addCss('default');
}

public function addCss($file)
{
    $cssFolder = 'media/plg_system_custom/css';

    $doc = JFactory::getDocument();
    $doc->addStylesheet($cssFolder . '/' . $file . '.css');
}
```

---
# Adding CSS and JS (++)

```php
public function onAfterInitialise()
{
    $this->addCss('default');
}

public function addCss($file)
{
    $pluginName = basename(__DIR__);
    $pluginGroup = basename(dirname(__DIR__));
    $pluginFullName = 'plg_' . $pluginGroup . '_' . $pluginName;

    $cssFolder = 'media/' . $pluginFullName . '/css';

    $doc = JFactory::getDocument();
    $doc->addStylesheet($cssFolder . '/' . $file . '.css');
}
```

---
# Adding CSS and JS (+++)

```php
public function onAfterInitialise()
{
    $this->addCss('default');
}

public function addCss() {}

public function getCssFolder() {}

public function getFullPluginName() {}

```

---
# Mental notes
- All methods should become very generic


---
# Modifying HTML (1)

```php
public function onAfterRender()
{
    $body = JResponse::getBody();
    $body = $this->replaceTags($body);
    JResponse::setBody($body);
}
```
---
# Modifying HTML (2)

```php
public function replaceTags($body)
{
    if (preg_match_all('/\{fa\ ([^\}]+)\}/', $body, $matches))
    {
        foreach ($matches[0] as $index => $match)
        {
            $tag = '@todo';
            $body = str_replace($matches[0][$index], $tag);
        }
    }

    return $body;
}
```

---
# Authentication Plugin (1)
```php
public function onUserAuthenticate($credentials, $options, &$response)
{
    $username = $credentials['username'];
    $password = $credentials['password'];

    $validate = $this->validate($username, $password);

    if($validate == false)
    {
        $response->status = JAuthentication::STATUS_FAILURE;
        $response->error_message = 'Could not authenticate';
        return false;
    }

    $response->status = JAuthentication::STATUS_SUCCESS;
    $response->error_message = '';
    return true;
}
```

---
# Authentication Plugin (2)
```php
public function validate($username, $password)
{
    $doSomething = false;

    if ($doSomething == true)
    {
        return true;
    }

    return false;
}
```

---
class: center, middle
# Reuse your code
### Reacting on the mental notes

---
# Mental notes
- Every method should have a single purpose
- Loose coupling of methods reduces complexity
- The more we reuse our code, the better

---
# Possible solution: Traits
- Determine in code, so not mixins
- Add trait when needed

---
# Basic inheritance
```php
class A
{
    public function doSomeTask() {}
}

class B extends A
{
}

$b = new B;
$b->doSomeTask();
```

---
# Basics of traits
```php
trait A
{
    public function doSomeTask() {}
}

class B extends A
{
}

$b = new B;
$b->doSomeTask();
```

---
# Traits: Basic plugin layout
```php
class PlgSystemCustom extends PlgSystemCustomAbstract
{
    use \SomeGroup\SomeTask;

    public function onAfterRender()
    {
        $this->doSomeTask();
    }
}
```

---
class: center, middle
# Traits code
### https://github.com/yireo/plg_system_traits

---
# Possible solution: Mixins
- Determined in runtime, so not traits
- Use a parent class

---
# Mixins: Basic plugin layout
```php
class PlgSystemCustom extends PlgSystemCustomAbstract
{
    protected $mixins = array(
        'somegroup/sometask',
    );

    public function onAfterRender()
    {
        $this->doSomeTask();
    }
}
```

---
class: center, middle
# Mixins code
### https://github.com/yireo/plg_system_mixins


---
class: center, middle
## thanks
### tweet me via @yireo

