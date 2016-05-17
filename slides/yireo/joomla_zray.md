layout: true
<div class="slide-heading">Zend Z-Ray and Joomla</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com  - #jab16 - @yireo / @jissereitsma</span>
</div>

---
class: center, middle
# Zend Z-Ray
### Extensible toolbar in Joomla

---
class: center, middle
# http://slides.yireo.com/

---
# Jisse Reitsma
- Founder and lead developer of Yireo
- Author of "Programming Joomla Plugins"
- Trainer & speaker
- Part of Zend Z-Team
- Untrained idiot on a bicycle

---
# This presentation
- Zend Server & Z-Ray
- Z-Ray plugin for Joomla
- Z-Ray code

---
class: center, middle
# Zend Server 9
### and Z-Ray

---
# Zend Server
- Easy setup of full stack (XAMPP on steroids)
- Application monitoring and code tracing
- Job Queue, Page Caching

---
# Z-Ray
- Live debugging tool
- Webbased toolbar
- Built on top of Zend Server
    - But also a standalone version available!
    - Zend Server Events
    - Interaction with ZS dashboard
- Extensible via Z-Ray plugins

---
# Z-Ray
<p class="center">
<img class="img-responsive" src="../slides/yireo/images/z-ray_01.png" />
</p>

---
class: center, middle
# Z-Ray for Joomla
### Joomla specific Z-Ray toolbar

---
# Z-Ray for Joomla
- Open source project
    - https://github.com/yireo/Z-Ray-Joomla
- Installation
    - Copy files to runtime folder
        - `/opt/zray/runtime/var/plugins`
        - `/usr/local/zend/var/zray/extensions`
    - Or easily install via Z-Ray backend

---
# Features
- Showing rendered modules
- Showing triggered events
- Showing plugins called upon
- Request data
- Configuration data

---
# Benefits
- Drop-in support for toolbar
    - Run your server with Z-Ray
    - Add Joomla app
    - Done
- Z-Ray backend dashboard
    - Reporting AJAX calls
- Integration with Zend Server

---
<p class="center">
<img class="img-responsive" src="../slides/yireo/images/z-ray_02.jpg" />
</p>

---
class: center, middle
# Z-Ray code

---
# Z-Ray code
```
zray/zray.php
zray/Module.php
zray/Panels/example.phtml
route/route.php
deployment.json
logo.png
```

---
# Dispatching a class
```php
class Foobar {}

$foobar = new Foobar();
$foobar->setZRay(new ZRayExtension('foobar'));
$foobar->getZRay()->setEnabledAfter('include_once');
```

---
# Dispatching Joomla class
```php
class Joomla {}

$zrayJoomla = new Joomla();
$zrayJoomla->setZRay(new ZRayExtension('joomla'));
$zrayJoomla->getZRay()->setEnabledAfter('JFactory::getApplication');
```

---
# Tracing functions (1 of 2)
```php
// ZRayExtension::traceFunction($pattern, $onEnter, $onLeave);

$onEnter = function() {};
$onLeave = array($zrayJoomla, 'afterPathFind');

$zrayJoomla->getZRay()->traceFunction(
    'JPath::find', 
    $onEnter, 
    $onLeave
);
```

---
# Tracing functions (2 of 2)
```php
public function afterPathFind($context, &$storage)
{
    $arguments = $context['functionArgs'];
    if (empty($arguments)) {
        return;
    }
    $path = $context['returnValue'];
    $joomlaPath = str_replace(JPATH_ROOT, '', $path);
    $this->joomlaPathFiles[] = array(
        'Relative Path' => $joomlaPath,
        'Absolute Path' => $path,
    );
}
```

---
# Outputting data
```php
public function foobar($context, &$storage)
{
    $storage['foobar'] = array(
        'Some name' => 'Some Value',
    );
}
```

---
# More
- Routing API
    - Telling Zend Server about your routing logic
- Panels, view scripts and widgets
- Online Editor
- More plugins
    - Composer, Apigility, Magento, OPCache

---
# Build it yourself
- Extension-specific debugging
- Logging from Z-Ray to Joomla logger

---
class: center, middle
## thanks
### tweet me via @yireo
