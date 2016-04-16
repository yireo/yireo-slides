layout: true
<div class="slide-heading">Snellere Joomla sites met PHP 7</div>
<div class="slide-footer">
    <span>Yireo - Opening Up Technologies - slides.yireo.com</span>
</div>

---
class: center, middle
### snellere Joomla sites met
# PHP 7

---
# Joomla en PHP 7
- PHP 7 in december 2015 verschenen
- Joomla 3.5 in maart 2016 verschenen
    - Support voor PHP 7
- Meeste Joomla extensies compatibel

---
# Joomla 3.5 testen
- Testomgeving opzetten met PHP 7
- Copieren Joomla bestanden en database
- Testen van functionaliteit

---
class: center, middle
# PHP 7 ???

---
class: center, middle
# PHP
### */fp/*

---
class: center, middle
# PHP
### Personal Home Page

---
class: center, middle
# PHP
### PHP Hypertext Preprocessor

---
# Geschiedenis (1 van 2)
- [1994] Geschreven door Rasmus Lerdorf
--

- [1994] PHP > FI (Forms Interpreter)
--

- [1995] Open sourced
--

- [1996] PHP/FI versie 2 (ofwel PHP 2)
--

- [1998] PHP 3 met Andi Gutmans en Zeev Suraski
--

- [1999] A**nd**i en **Ze**ev richten Zend op
--

- [2000] PHP 4 met Zend Engine

---
# Geschiedenis (2 van 2)
- [2004] PHP 5.0
--

- [2005] PHP 5.1
--

- [2006] PHP 5.2
--

- [2009] PHP 5.3
--

- [2012] PHP 5.4
--

- [2013] PHP 5.5
--

- [2014] PHP 5.6
--

---
# PHP 6

--
- PHP 5 had geen unicode support
    - Unicode ofwel UTF-8 ofwel multibyte ofwel UTF-16
    - Support voor Arabisch, Chinees en Klingon
    - Wel `mb_` multibyte functies

---
# PHP 6
- PHP 5 had geen unicode support
- PHP 6 development begon in 2005
    - Tussen PHP 5.2 en PHP 5.3
    - Voornaamste doel integreren van unicode support

---
# PHP 6
- PHP 5 had geen unicode support
- PHP 6 development begon in 2005
- Project werd in 2010 definitief opgedoekt
    - Gebrek aan developers
    - Intern geharrewar
    - Traits en closures overgezet naar PHP 5.4

---
# Geschiedenis (rev.)
- ...
- [2009] PHP 5.3
- PHP 6
- [2012] PHP 5.4
- [2013] PHP 5.5
- [2014] PHP 5.6
- ...

---
# HHVM

--
- Ofwel: HipHop VM
--

- Ontwikkeld door Facebook
--

- Publiek gemaakt in 2013
--

- JIT compiler / transpiler
--

- Hack taal t.v.v. PHP
--

- 2x sneller dan PHP 5.6

---
# PHP 7
--

- Origineel gelabeled `phpng` (Next Generation)
--

- Publieke stemming om dit niet 5.7 te noemen
--

- 2x sneller dan PHP 5.6
--

- Dank aan Zend

---
# Zend
- PHP
--

- Zend Studio
--

- Apigility
--

- Zend Framework
--

- Zend Server + Z-Ray
--

- Z-Ray plugin for Joomla

---
# PHP 7 features
- Abstract Syntax Tree optimalisatie
--

- Spaceship operator
    - Omdat het op een raket lijkt: `<=>`
    - `$a < $b` is gelijk aan `($a <=> $b) === -1`
--
- Null coalescing
    - Oud: `$b = (isset($a['c'])) ? $a['c'] : false;`
    - Nieuw: `$b = ($a['c']) ?? false;`
--


---
# Huidige status
- PHP 7 stabiel
- PHP 5.6 support tot december 2016
- PHP 5.5 obsolete
- PHP 5.4 obsolete
- PHP 5.3 obsolete
- HHVM minder nuttig
- Node.js?

---
# Overstappen
- Testen
- Hosting provider spammen
- Achterover leunen

---
class: center, middle
# PHP 7 ist da
