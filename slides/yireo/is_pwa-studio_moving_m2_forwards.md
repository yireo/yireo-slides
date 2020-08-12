{state: main middle}
{background-image: kiel/crossroads.jpg}
# Is PWA Studio moving Magento 2 forward?
## Or not?
### Coined by Jisse Reitsma

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of backend and frontend developers
  - Magento, React, PWA Studio, Vue Storefront, GraphQL
~ Magento Master 2017/2018/2019 Mover
~ Member of ExtDN (Magento Extension Developer Network)
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon v1 and v2 (2018)
~ Creator of Reacticon v4 (June 2021)
~ And currently promoting Reacticon v3 Online (October 2021)

---
{state: main middle dark}
{background-image: kiel/doubts.webp}
# Is PWA Studio moving Magento 2 forward?

---
# PWA
- Progressive Web Apps
- Tools
	- Serviceworker
	- Manifest file
	- Skeleton HTML to load JavaScript as quickly as possible (app shell)

---
# PWA Studio
~ Headless toolbox created by Magento
~ SPA using React, Redux, Apollo Client, GraphQL
~ Consisting of Venia, Peregrine, UPWARD and Buildpack
~ PWA Studio 7 is out with extensibility
~ It is ready to build projects with
~ Or is it?

---
# Current state of PWA Studio in community
~ Not that many projects have been built on top of PWA Studio
~ Some projects that have been built on top of PWA Studio are only using little code of Venia
~ Best practices still need to arise
~ Many people are doubting its success
~ Many people are doubting its use
~ Many people are doubting whether there is any benefit from moving over to PWA at all

---
# Benefits of PWA
~ Easier ways to accomplish higher scores on Lighthouse
	- Bundling JSS and CSS
	- Critical CSS
	- Prefetching resources dynamically
	- Optimizing DOM structure
~ Better adoptation of new browser features
	- Offline and network information
	- Push notifications
	- Battery API
	- ...

---
# Misconceptions
~ SPA is not PWA
~ The revolution is not PWA, but headless
~ Headless means that you can build what you want
	- Different mindset in agency, different roles
	- Magento gets a smaller role in the total stack
~ You do NOT need the help of the Magento company to build a SPA yourself
	- They can provide help and guidance, they can provide tools
	- But they are not solely responsible for the frontend we build

---
# Backend stack
- Magento
- PHP-FPM & Nginx
- Redis
- ElasticSearch
- Rabbit MQ

In headless philosophy, this produces one thing: GraphQL output

---
# Frontend stack
- Vue or React
	- Each with their own development environment
- GraphQL backend
	- Proxying GraphQL requests (UPWARD, Varnish, custom proxy)?
- SSR (Rendertron) service

---
{state: main middle dark}
{background-image: heman/heman-shera.jpg}
# Don't forget about Reacticon v3 Online
### October 13th-15th (free attendance)

---
{state: main middle dark}
{background-image: heman/heman-shera.jpg}
# Thanks
## Contact me via @jissereitsma or @yireo
