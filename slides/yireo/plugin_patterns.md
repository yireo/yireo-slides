layout: true
<div class="slide-heading">Joomla Plugin Concepten</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com</span>
</div>

---
class: center, middle
# Joomla plugin concepten
### want wat zijn plugins eigenlijk

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
# Verwarrende synoniemen
- Extensies
- Modules
- Plugins
- Componenten

---
# Extensie typen
- *Componenten* = hoofddoel van webpagina
- *Modules* = extra functionaliteit
- *Plugins*
- *Templates* = huisstijl
- *Libraries* = voor developers

---
# Joomla Plugins
- Plugingroepen
- Events
- PHP code

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
# Design concepten
- Observer & Observable (events)
    - Observable knows about Observers
- Publisher & Subscriber
    - Publisher message is anonymous
- Chain of Command
    - Joomla authentication

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
## thanks
### http://yir.io/pjp

