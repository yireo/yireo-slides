layout: true
<div class="slide-heading">Best coding practices</div>
<div class="slide-footer">
    <span>#mm18nyc | @yireo | @jissereitsma</span>
</div>

---
class: center, middle
# Best coding practices
### according to ExtDN

---
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of Magento 2 developers
~ Creator of MageTestFest & Reacticon
~ Member of ExtDN.org
~ Magento Master 2017 & 2018 Mover


---
class: center, middle
# ExtDN
### https://extdn.org/

---
# ExtDN Working Groups
- ExtDN Extension Quality
    - Collaboration with Magento Marketplace
    - PHP CodeSniffer
- ExtDN Interoperability
    - PWA & Magento extensions

~ ExtDN Communications
    - Talk with each other
    - Talk with Magento & Adobe
    - Talk with you

---
# 8 points
~ 1. Do Use Composer
~ 2. Do Use Service Contracts
~ 3. Do Write Tests
~ 4. Do Document Your Dependencies
~ 5. Do Version Releases
~ 6. Do Provide A User Manual
~ 7. Do Use Events And Plugins
~ 8. Do Check Your Code

---
# 1. Do Use Composer
"Use composer packages to distribute (especially commercial) extensions. For a local environment, it is fine to develop your own code under app/code. However, once you distribute your module to other environments, it should be through composer as otherwise dependencies are left unmanaged. In a production environment, the app/code folder should therefore ideally be empty."

---
# 8. Do Check Your Code
"Use a static analysis tool like PHP CodeSniffer (with the ExtDN and MEQP rulesets). Check whether your extension works in Production Mode. Confirm your extension works under the Magento versions that you claim compatibility with. Have a colleague or friend review your code before releasing it."



---
class: center, middle
## thanks
### tweet me via @yireo