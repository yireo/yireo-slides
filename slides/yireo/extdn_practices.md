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
- Extension Quality
- Interoperability
- Communications

---
# ExtDN Working Groups
- Extension Quality
    - Collaboration with Magento Marketplace
    - PHP CodeSniffer
- Interoperability
- Communications
    
---
# ExtDN Working Groups
- Extension Quality
- Extension Interoperability
- Communications
    - Talk with each other
    - Talk with Magento & Adobe
    - Talk with you

---
# ExtDN Working Groups
- Extension Quality
- Extension Interoperability
- Communications
    - Talk with each other
    - Talk with Magento & Adobe
    - Talk with you

---
# Some of the goals
~ Better extension quality
~ Less bugs, less conflicts
~ More happiness

---
# 8 points
~ Do Use Composer
~ Do Use Service Contracts
~ Do Write Tests
~ Do Document Your Dependencies
~ Do Version Releases
~ Do Provide A User Manual
~ Do Use Events And Plugins
~ Do Check Your Code

---
# 1. Do Use Composer
"Use composer packages to distribute (especially commercial) extensions. For a local environment, it is fine to develop your own code under app/code. However, once you distribute your module to other environments, it should be through composer as otherwise dependencies are left unmanaged. In a production environment, the app/code folder should therefore ideally be empty."

---
# 1. Do Use Composer
~ Use composer packages
~ Especially commercial extensions should use composer
~ Locally, you can use `app/code`
~ (Note that we are not talking about themes here)
~ But with deployment, composer should be used
~ And `app/code` should be empty

---
# 8. Do Check Your Code
"Use a static analysis tool like PHP CodeSniffer (with the ExtDN and MEQP rulesets). Check whether your extension works in Production Mode. Confirm your extension works under the Magento versions that you claim compatibility with. Have a colleague or friend review your code before releasing it."



---
class: center, middle
## thanks
### tweet me via @yireo