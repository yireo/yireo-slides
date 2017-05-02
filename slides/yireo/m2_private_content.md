layout: true
<div class="slide-heading">M2 Private Data via JS Components</div>
<div class="slide-footer">
    <span>M2 Private Data via JS Components - Jisse Reitsma - Meet Magento NL 2017</span>
</div>

---
class: center, middle, world, bgimage
# Magento 2 Private Data
## via JS Components

Meet Magento Netherlands 2017

---
class: orange
# About me
- Jisse Reitsma
--

- Founder and lead developer of Yireo
--

- Trainer, enterpreneur, coder
--

- Magento 2 Master "Mover" (2017)
--

- Knockout JiSse (I don't why)
--

- Loving Magento 2

---
# My talk
- Private Content
    - Hole punching in FPC
- JS Components
    - RequireJS
    - KnockoutJS

---
# Full Page Cache
- Shipped out of the box with M2
    - CE and EE
    - Native Magento cache or Varnish Cache

---
# Optimizations
- Make sure no blocks are using `cacheable=false`
- Enable FPC with Magento caching
- Set caching handler to Redis (or memcache)
- Switch to Varnish

# cacheable=false
```xml
<layout>
  <referenceBlock name="category.products.list">
    <arguments>
      <argument name="cacheable" xsi:type="bool">false</argument>
    </arguments>
  </referenceBlock>
</layout>
```

NOTE: This prevents FPC on this entire page

---
# Checking for FPC
- Enable FPC
- Open up Error Console and check for HTTP headers
- FPC is working
    - `X-Magento-Cache-Control: MISS`
    - `X-Magento-Cache-Control: HIT`
- FPC is not working
    - `X-Magento-Cache-Control: MISS`
    - `X-Magento-Cache-Control: MISS`

---
# Reasons why cacheable=false
- Bad third party modules
- Module `Magento_Captcha` is enabled

@todo

---
# MageTestFest
- November 15th-18th 2017
- Somewhere in The Netherlands
- 5 awesome speakers
    - 1st announcement: Vinai Kopp

[magetestfest.nl](https://magetestfest.nl/)

---
class: center, middle, world
# Any questions?
### @yireo
### @jissereitsma

