layout: true
<div class="slide-heading">A System Plugin per project</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com</span>
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
- Author of "Programming Joomla Plugins"
    - Missing guide for plugins
    - For both beginner and experienced developer
    - Available as dead-tree-format (ebook in August)

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
- About System Plugins
- Practical scenarios
    - JForm forms
    - Reusing logic
- Sample Custom Plugin with mixins

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
# Mixins
### Reacting on the mental notes

---
# Mental notes
- Every method should have a single purpose
- Loose coupling of methods reduces complexity
- The more we reuse our code, the better

---
# Possible solution: Mixins
- Determined in runtime, so not traits
- Use a parent class

---
# Basic plugin layout
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
# Basic plugin layout
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
# Demo
### https://github.com/yireo/plg_system_custom


---
class: center, middle
## thanks
### tweet me via @yireo

