layout: true
<div class="slide-heading">Joomla Plugins &amp; Events</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com</span>
</div>

---
class: center, middle
# Joomla plugins 
### introductie tot plugins &amp; events

---
# Jisse Reitsma
- Oprichter van Yireo
- Auteur van "Programming Joomla Plugins"
    - Engels-talig boek
    - Echt voor programmeurs
- Programmeur en ondernemer

---
# Missie
- Technologie openen voor anderen
- Alles wat simpel is moeilijk maken

---
# Joomla Plugins
- Plugingroepen
- Events
- PHP code

---
# Extensie typen
- *Componenten* = hoofddoel van webpagina
- *Modules* = extra functionaliteit
- *Plugins*
- *Templates* = huisstijl
- *Libraries* = voor developers

---
# Plugin definitie
- Werkt op de "achtergrond"
- Taken worden verwerkt via *events*
- Flexibel maar complex

---
# Plugin groepen (1 van 2)
- *Content* = Inhoud
- *Authentication* = Authenticatie
- *System* = Systeem
- *User* = Gebruiker
- *Search* = Zoeken
- *Smart Search* (`finder`) = Slim Zoeken

---
# Plugin groepen (2 van 2)
- *Captcha*
- *Two Factor Authentication*
- *Editor* = Tekstverwerker
- *Button* (`editors-xtd`) = Knop
- *Quick Icons* = Snelkoppelingen

---
# Derde partij plugins
- E-commerce (payment, shipment)
    * Hikashop, RedShop, VirtueMart
- Content (extra velden, automatische content)
    * K2, ZOO, SimpleLists, Seblod
- Gewoon uitbreidbaar maken
    * Kunena, Dynamic404, Akeeba Subscriptions

---
class: center, middle
### (demo)

---
# Events
- Technische manier om in te haken op iets
- Een event wordt *getriggered*
    - Door een component
    - Door een module
- Een event staat gelijk aan een stuk PHP code
    - `onContentDisplayBefore`
    - `onUserAuthenticate`

---
# Content events
- `onContentSaveBefore` = Voordat een artikel wordt opgeslagen
- `onContentSaveAfter` = Nadat een artikel wordt opgeslagen
- `onContentDisplayBefore` = Voordat een artikel wordt getoond

---
# User events
- `onUserBeforeSave` = Voordat een gebruiker wordt opgeslagen
- `onUserAfterSave` = Nadat een gebruiker wordt opgeslagen
- `onUserLogin` = Op het moment dat gebruiker in logt
- `onUserLogout` = Op het moment dat gebruiker uit logt

---
# User/Joomla folder
`plugins/user/joomla/`

* `joomla.php`
* `joomla.xml`
* `index.html`

---
# PHP intro in 30 seconden
* Programmeertaal
* Object georienteerd programmeren
    * Objecten zijn instanties van klassen
    * Klassen bestaan uit code-onderdelen
        * Variabelen (`variables`)
        * Methoden (`methods`)

---
# User/Joomla plugin
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
* Plugin klasse extends van `JPlugin` klasse
* Events afvangen via methodes
    - Ik noem het *event methodes*
    - Access: `public`
* Extra code in andere methoden
    - Ik noem het *helper methodes*
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
class: center, middle
### (doodse stilte)

---
# Dus
- Plugins
- Groepen
- Events

---
# Groepen?
- Groepen zijn niet fijn omlijnd
    - Logins zitten zowel bij *Authentication* als *User*
    - Login is compleet iets anders dan opslaan van gebruiker
- Groepnaam vaak toch nog onduidelijk
    - Wat doet de `System` groep?

---
# Alles door elkaar heen?
- Meerdere events uit meerdere groepen afvangen
    - Profile: Content + User 
    - Remember me: System + User
- Systeem plugins mogen alles
    - Geactiveerd bij opstarten Joomla
    - Kunnen alle events afvangen

---
# Praktisch (1/2)
- Wees voorzichtig met extra plugins installeren
- Let op de volgorde van plugins
    - SEF plugin altijd als laatste
    - Cache plugin als allerlaatste
- Zet datgene uit wat je niet nodig hebt
    - System/Debugging (Foutsporing)
    - System/Log (Gebruikerslog)

---
# Praktisch (2/2)
- Wees voorzichtig met System/Cache plugin
    - *Full page caching*
    - Nooit op e-commerce site

---
class: center, middle
### (wie is er nog wakker?)

---
class: center, middle
## thanks
### http://yir.io/pjp

