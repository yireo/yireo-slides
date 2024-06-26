# Monolith vs Composable Commerce

---
# About me
- Jisse Reitsma
- Founder of Yireo
- Training developers
    - Magento / Adobe Commerce
    - Shopware / Symfony
    - React / Vue
- Open source extensions

---
# Monolith
- Frontend & backend integrated in one system
    - Magento Admin Panel and Luma frontend team
    - Shopware Administration and Storefront
- Examples
    - Magento
    - Shopware

---
# Composable Commerce
- Cloud-native
- Component-based
- Technology-agnostic
- Examples
    - Alokai (Vue Storefront)
    - DEITY

---
# Composable Commerce
- Cloud-native
  - 
- Component-based
    - CRM, ERP, PIM, ...
- Technology-agnostic
    - Headless with React or Vue

---
# Benefits of composable commerce
- More flexibility
- Choose your own e-commerce

---
# Definition: Monolith
"A large single upright block of stone, especially one shaped into or serving as a pillar or monument."

---
# Definition: Monolithic application
"A single unified software application that is self-contained and independent from other applications, but typically lacks flexibility."

---
# Definition: Composable commerce
"Composable commerce is a development approach of selecting best-of-breed commerce components and combining them into a custom application built for specific business needs."

---
# A typical Magento "monolith"
- Magento backend
- Magento frontend with Hyvä theme
- PHP-FPM
- Nginx
- MySQL
- Redis
- ElasticSearch
- Varnish
- (RabbitMQ)
- (Load balancers)
- (CDN)

---
# An example composable commerce shop
- PIMcore
- CommerceTools e-commerce backend
- React frontend using GraphQL API
- Headless CMS
- Custom ERP
- Custom CRM

---
# An example headless monolithic shop
- PIMcore
- Magento e-commerce backend
- React frontend using GraphQL API
- Custom ERP
- Custom CRM
- Headless CMS

---
# So, what is the difference?

---
# A hype?

---
# Definition: Hype
"A situation in which something is advertised and discussed in newspapers, on television, etc. a lot in order to attract everyone's interest"

---
# Hypes in the past
- Service Oriented Architecture
- Microservices
- Headless

---
# Composable Commerce beyond the hype
- MACH (Microservices, API-first, Cloud-native, Headless)
- PBC (Packaged Business Capabilities)

---
# Does Magento/Shopware support microservices?
Yes. Note that microservices are not standardized, so every microservice requires its own integration.

---
# Is Magento/Shopware built with API-first approach?
Magento 2, no. Shopware 6, yes.

---
# Is Magento/Shopware cloud-native?
No, they are written at-first with a server-based architecture in mind

---
# Is Magento/Shopware cloud-ready?
Yes, they run fine on Amazon AWS, Microsoft Azure, Google Cloud and Kubernetes

---
# Does Magento/Shopware offer a headless solution?
Yes, Magento offers PWA Studio, Shopware offers Frontends, or you built something custom

---
# Choose what fits you best
- What is needed
- How much does it cost
- What feels right

The terms monolith and composable commerce lead you away from the fact that you need to make this choice