layout: true
<div class="slide-heading">Een System Plugin per project</div>
<div class="slide-footer">
    <img src="images/yireo-logo.png" width="40" align="left" /> <span>www.yireo.com + slides.yireo.com</span>
</div>

---
class: center, middle
# Joomla Plugins
### een eigen System Plugin per project

---
class: center, middle
# http://slides.yireo.com/

---
# Jisse Reitsma
- Oprichter van Yireo
- Auteur van "Programming Joomla Plugins"
    - Engels-talig boek
    - Voor beginnende en ervaren programmeurs
- Programmeur en ondernemer

---
# Yireo Educatie
- Joomla Development Crash Course
    - woensdag 08 juli 2015
- Dutch Joomla PHP Developers: PhpStorm
    - dinsdag 21 april 2015
- Expert Sessie met Perfect Web Team
    - ? mei/juni 2015
    
https://www.yireo.com/training/events/

---
# Deze presentatie
- Over System Plugins
- Praktische scenarios
    - JForm formulieren en veld-typen
    - Tags vervangen (FontAwesome)
    - Eigen authenticatie
    - Meer braindumps

---
# Joomla Plugins
- Plugin Groepen
    - Content
    - **System**
    - Authentication
- Plugin Events / Methodes
    - `onContentPrepare`
    - `onAfterInitialise`
    - `onUserAuthenticate`

---
# Snel aan de slag
- Iedere Joomla plugin heeft plugin-klasse
- Binnen plugin-klasse definieer je methodes
- Methodes zijn gelijknamig aan plugin event
- Plugin methode vangt plugin event af
- MEGATIP: System Plugin vangt ALLE events af

---
# System Plugin skelet
```php
defined('_JEXEC') or die;

class PlgSystemCustom extends JPlugin
{
    protected $app;
    protected $db;

    public function onAfterInitialise() {}
    public function onContentPrepare($context, &$row, $params, $page = 0) {}
    public function onUserAuthenticate($credentials, $options, &$response) {}

    private function doSomething() {}
    private function doSomethingElse() {}
}
```

---
# Plugin in PHP
* Plugin klasse extends van `JPlugin` klasse
* Events afvangen via methodes
    - Ik noem het *event methodes*
    - Access: `public`
* Extra code in andere methoden
    - Ik noem het *helper methodes*
    - Access: `protected` of `private`

---
class: center, middle
# Scenario #1
## Content aanpassen

---
# Content in Joomla
- Artikel
    - titel, text, auteur, datum, tags, categorie, taal
- Boek
    - uitgeverij, boek auteur, verschijningsdatum, boek taal
- Recept
    - ingredienten, type keuken, benodigde tijd
- Blog
    - auteur bio, toon social media (J|N)

---
# JForm in plugins
- Toevoegen van eigen `JForm` code
    - Definieren eigen XML file
    - Fuseren van eigen XML met bestaande formulier
- Zie ook "Joomla Webdesigner Special" (2015)

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
# Formulier toevoegen

```php
public function onContentPrepareForm($form, $data)
{
    JForm::addFormPath(__DIR__ . '/form');
    $form->loadFile('form');
}
```

---
# Waar zijn formulieren?
- Content beheer
    - Artikel, Categorie, Weblink, Contact
- Module beheer
- Menu-Item beheer
- Template beheer
- Eigen formulieren in frontend
    
---
class: center, middle
# Scenario #2
## Eigen tags in content

---
# FontAwesome iconen
- CSS gebaseerde iconen

<i class="fa fa-quote-left"></i>
<i class="fa fa-quote-left fa-3x"></i>
<i class="fa fa-quote-left fa-3x fa-border"></i>
<i class="fa fa-spinner fa-spin"></i>
<span class="fa-stack fa-lg">
  <i class="fa fa-square-o fa-stack-2x"></i>
  <i class="fa fa-twitter fa-stack-1x"></i>
</span>
<span class="fa-stack fa-lg">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
</span>

---
# FontAwesome in code

```html
<i class="fa fa-quote-left"></i>
<i class="fa fa-quote-left fa-3x"></i>
<i class="fa fa-quote-left fa-3x fa-border"></i>
<i class="fa fa-spinner fa-spin"></i>

<span class="fa-stack fa-lg">
  <i class="fa fa-square-o fa-stack-2x"></i>
  <i class="fa fa-twitter fa-stack-1x"></i>
</span>

<span class="fa-stack fa-lg">
  <i class="fa fa-circle fa-stack-2x"></i>
  <i class="fa fa-flag fa-stack-1x fa-inverse"></i>
</span>
```

---
# FontAwesome Joomla
Inladen van FontAwesome via gemakkelijke syntax

    {fa fa-spinner fa-spin}

    {fa spinner spin}

    mytwitter="stack [square-o stack-2x][twitter stack-1x]"
    {fa mytwitter}

    myflag="stack [circle stack-2x][flag stack-1x inverse]"
    {fa myflag}

https://github.com/yireo/plg_system_fontawesome

---
# Plugin logica
- Voeg FontAwesome CSS en JS toe
- Pas HTML document aan
    - Find all tags beginnend met `{fa` en eindigend met `}`
    - Vervang die tags met echte HTML-elementen

---
# Plugin skelet

```php
class PlgSystemCustom extends JPlugin
{
    public function onAfterInitialise()
    {
        // Add CSS and JS
    }

    public function onAfterRender()
    {
        // Modify HTML
    }

    protected function replaceTags($body)
    {
        // Modify HTML
    }
}
```

---
# JS en CSS toevoegen

```php
public function onAfterInitialise()
{
    $document = JFactory::getDocument();
    $document->addStylesheet('media/custom/css/custom.css');
    $document->addScript('media/custom/js/custom.js');
}
```

---
# HTML aanpassen (1)

```php
public function onAfterRender()
{
    $body = JResponse::getBody();
    $body = $this->replaceTags($body);
    JResponse::setBody($body);
}
```

---
# HTML aanpassen (2)

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
class: center, middle
# Scenario #3
## Eigen authenticatie

---
# Eigen authenticatie
- Per token
- Per IP adres
- Per Authenticatie Plugin

---
# Per token
```php
public function onAfterRoute()
{
    $token = $this->app->input->getCmd('token');

    if ($token != $this->params->get('token'))
    {
        die('UnAuthorized');
    }
}
```

---
# Authenticatie Plugin (1)
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
# Authenticatie Plugin (2)
```php
public function validate($username, $password)
{
    $hackMySite = true;

    if ($hackMySite == true)
    {
        return true;
    }

    return false;
}
```

---
class: center, middle
# Braindump

---
# Braindump
- Voeg JS en CSS toe, los van template
    - Font Awesome, jQuery UI, Bootstrap 3, Foundation
- Search Plugins voor derde partij componenten
- GeoIP locatie in combinatie met formulier velden
- Definieren van `JFormFields`
    - Landen selector, jQuery UI
- AJAX calls afvangen via `com_ajax`

---
# Meer weten?
- Mijn boek "Programming Joomla Plugins"
    - Beginners: events, klasse, XML, voorbeeld code
    - Gevorderden: TFA, finder, Phing, unit testing
- Yireo Educatie
    - Extra tutorials & screencasts
    - Trainingen
- Weblinks
    - http://yir.io/pjp
    - https://github.com/yireo/

---
class: center, middle
## @yireo 

