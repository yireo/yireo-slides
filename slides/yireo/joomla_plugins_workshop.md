layout: true
<div class="slide-heading">Joomla Plugins Workshop</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com  - #jwc16 - @yireo / @jissereitsma</span>
</div>

---
class: center, middle
# Writing your own
### Joomla Plugins

---
class: center, middle
# http://slides.yireo.com/

---
# Jisse Reitsma
--

- Founder and lead developer of Yireo
--

- Author of "Programming Joomla Plugins"
--

- Trainer & speaker
--

- Part of Zend Z-Team
--

- Untrained idiot on a bicycle

---
# This workshop
- You are going to write plugins
- I'm going to help you

---
# Timeline (2 hours)
- This introduction
- Do it yourself (workshop)
- Evaluation (5 min)

---
class: center, middle
# 10 scenarios

---
# 0 - Base skeleton
- Mission:
    - Trim the title of each article before saving
- Steps
    - Create a folder structure
    - Add an XML file
    - Add a plugin class

---
# 1 - Trim the title
- Mission:
    - Trim the title of each article before saving
- Steps
    - Create a Content Plugin
    - Use the event `onBeforeSave()`

---
# 2 - New article field
- Mission
    - Add a new field to "Edit Article"
- Steps
    - Create a Content Plugin
    - Create a new JForm XML file
    - Use the event ????

---
# 3 - Remote authentication
- Mission
    - Authenticate to dummyauth.yireo.com API
- Steps
    - Create an Authentication Plugin
    - Authenticate against `foo` / `bar` 

---
# 4 - Finder plugin
- Mission
    - Create a new taxonomy
- Steps
    - Create a new Finder Plugin
    - Add a new taxonomy with some values

---
# 5 - Replacing tags
- Mission
    - Replace some `{dummy arg=foobar}` tags
- Steps
    - Create a System Plugin

---
# 6 - Fix typos in URLs
- Mission
    - Autorepair typos in URLs
- Steps
    - Create a System Plugin
    - Use the routing events to fix URLs

---
# 7 - Whitelisted emails
- Mission
    - Only allow users from whitelisted emails
- Steps
    - Create a User Plugin

---
# 8 - Some jQuery effect
- Mission
    - Add some jQuery UI effect via a plugin
- Steps
    - Create a System Plugin

---
# 9 - Uninstall anything
- Mission
    - Uninstall any extension after installation
    - aka: Make it impossible to install extensions
- Steps
    - Create a System Plugin

---
# 10 - Whatever is cool for you
- Suggestions
    - Create a plugin that talks to Peter Martins RPi device

---
class: center, middle
# Where to begin

---
# Where to begin
- Choose your plugin group
    - Example: `plugins/system/example/example.php`
    - Example: `PlgSystemExample extends JPlugin`
- Create class skeleton
- Create XML file
- Discover your plugin
- Start adding methods

---
# Bits of OOP
- Write down your assignment in small paragraph
    - Nouns become objects, verbs become object methods
- Add the classes and methods to your code
- Define what goes in and out
    - Input arguments
    - Return value (output)

---
# Some other bits
- Create helpers
    - And come to my talk on why you shouldn't use helpers
- PhpStorm
- Add your repo to GitHub and commit often

---
class: center, middle
# Resources
- https://slides.yireo.com/joomla_plugins_workshop
- https://github.com/yireo/JoomlaPluginsBook
- https://docs.joomla.org/Portal:Developers/en#Plugins
