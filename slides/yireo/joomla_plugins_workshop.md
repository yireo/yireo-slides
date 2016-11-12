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

Laptops?

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
    - Create a base skeleton for any other work
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
    - Use the event `onContentBeforeSave()`

---
# 2 - New article field
- Mission
    - Add a new field to "Edit Article"
- Steps
    - Create a Content Plugin
    - Create a new JForm XML file
    - Use the event `onContentPrepareForm`

---
# 3 - Remote authentication
- Mission
    - Authenticate with http://joomla1.yireo-dev.com/dummyauth.php
- Steps
    - Create an Authentication Plugin
    - Use the event `onUserAuthenticate`
    - Authenticate with `?cmd=auth&username=foo&password=bar`
    - Or use `?type=help`

---
# 4 - Finder plugin
- Mission
    - Create a new taxonomy
- Steps
    - Create a new Finder Plugin
    - Add a new taxonomy with some values
    - Use the events `onFinder...`

---
# 5 - Replacing tags
- Mission
    - Replace some `{dummy arg=foobar}` tags
- Steps
    - Create a System Plugin
    - Use the event `onAfterRender`

---
# 6 - Fix typos in URLs
- Mission
    - Autorepair typos in URLs
- Steps
    - Create a System Plugin
    - Use the routing events to fix URLs
    - Use the event `onAfterInitialise`

---
# 7 - Whitelisted emails
- Mission
    - Only allow users from whitelisted emails
- Steps
    - Create a User Plugin
    - Use the event `onUserSaveBefore`

---
# 8 - Some jQuery effect
- Mission
    - Add some jQuery UI effect via a plugin
- Steps
    - Create a System Plugin
    - Use the event `onBeforeRender`

---
# 9 - Uninstall anything
- Mission
    - Uninstall any extension after installation
    - aka: Make it impossible to install extensions
- Steps
    - Create a System Plugin
    - Use the event `onInstallerAfterInstaller`

---
# 10 - Whatever is cool for you
- Suggestions
    - Create a plugin that talks to Peter Martins RPi device
    - Remove swearing words from content
    - Override a class file from the Joomla core

---
# Pick your scenario
- Go to slides.yireo.com
    - https://slides.yireo.com/joomla_plugins_workshop
- Take your pick

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
- Create helper classes
    - And come to my talk on why you shouldn't use helpers
- PhpStorm
- Add your repo to GitHub and commit often

---
# Resources
- https://slides.yireo.com/joomla_plugins_workshop
- https://github.com/yireo/JoomlaPluginsBook
- https://docs.joomla.org/Portal:Developers/en#Plugins
