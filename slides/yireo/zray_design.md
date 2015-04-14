layout: true
<div class="slide-heading">Joomla &amp; Zend Server Z-Ray - Templaters Aid</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com</span>
</div>

---
class: center, middle
# Joomla &amp; Z-Ray
### Joomla templates &amp; overrides<br/>with Zend Server Z-Ray

---
# Z-Ray &amp; Joomla
- Quick introduction
- Demo with Joomla templating

---
# Zend Server + Z-Ray
- Complete PHP Application Platform
    - Easy management of PHP configuration
--
- Helping developers
    - Event tracing and profiling
    - Zend Debugger
--
- Z-Ray
    - The must-have debugging solution for any PHP dev
    - Automatically inserted toolbar for any webapp
    - Z-Ray extensions &raquo; Joomla

---
# Z-Ray for Joomla
- Developed by Yireo
    - GitHub project
--
- Easy to use with Joomla
    - Drop a Joomla in Zend Server and it works
    - Quickly access vital debugging info
--
- Many different use-cases
    - Plugin development
    - Templating &amp; overrides

---
# Joomla overrides
- Templates
- Component layouts
- Module layouts

---
# Joomla overrides
- Templates
- Component layouts

<small>
`components/com_content/views/article/tmpl/default.php`
`templates/foobar/html/com_content/article/default.php`
</small>

- Module layouts

<small>
`modules/mod_menu/tmpl/default.php`
`templates/foobar/html/mod_menu/default.php`
</small>

---
class: center, middle
## Which Joomla layout is where?

---
# Module assignment
- To a Menu-Item
    - `Itemid=43`
- To a component
    - `option=com_content`
- To a page condition
    - `option=com_content`
    - `view=article`

---
class: center, middle
## Which modules are loaded?


---
class: center, middle
## thanks
### tweet us via @yireo
### https://github.com/yireo/Z-Ray-Joomla

