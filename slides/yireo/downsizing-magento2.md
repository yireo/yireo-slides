{state: main middle dark}
{background-image: heman/heman-rainbow.jpg}
# Downsizing Magento 2
## because less is more
### Presented to you by Jisse Reitsma

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of backend and frontend developers
  - Magento, React, PWA Studio, Vue Storefront, GraphQL
~ Creator of MageTestFest (2017, 2019)
~ Creator of Reacticon (2018 x2)
~ Creator of Reacticon v3 (October 2021)
~ Creator of Reacticon v4 (June 2021)
~ Magento Master 2017/2018/2019 Mover
~ Member of ExtDN (Magento Extension Developer Network)
~ Saya suka segalanya di Indonesia

---
{state: main middle dark}
{background-image: heman/greyskull.jpg}
# Magento of today
# in technical numbers

---
# Magento  of today
~ 519 composer packages
~ XYZ modules
~ XYZ lines of code
~ Numerous features that you might not need

---
{state: main middle dark}
{background-image: heman/greyskull.jpg}
# Removing modules

---
# Disable specific modules
```bash
bin/magento Foo_Bar
```

---
# Disable unneeded modules
```bash
bin/magento bin/magento Magento_AdvancedPricingImportExport Magento_AdminNotification Magento_Authorizenet Magento_Braintree Magento_Bundle Magento_BundleImportExport Magento_CacheInvalidate Magento_Captcha Magento_CatalogRuleConfigurable Magento_CatalogWidget Magento_CheckoutAgreements Magento_ConfigurableImportExport Magento_ConfigurableProduct Magento_Cookie Magento_CurrencySymbol Magento_CustomerImportExport Magento_Deploy Magento_Dhl Magento_DownloadableImportExport Magento_EncryptionKey Magento_Fedex Magento_GoogleAdwords Magento_GoogleAnalytics Magento_GoogleOptimizer Magento_GroupedImportExport Magento_LayeredNavigation Magento_Marketplace Magento_Multishipping 
Magento_NewRelicReporting Magento_OfflinePayments Magento_OfflineShipping Magento_Paypal Magento_Persistent Magento_ProductVideo Magento_SalesInventory Magento_SendFriend Magento_Sitemap Magento_Swagger Magento_Swatches Magento_SwatchesLayeredNavigation Magento_TaxImportExport Magento_Ups Magento_Usps Magento_Vault Magento_Version Magento_Webapi Magento_WebapiSecurity Magento_Weee
```

Reference https://www.integer-net.com/why-and-how-to-disable-magento-2-core-modules-improve-performance/

---
# Disable GraphQl modules
```bash
bin/magento module:disable `bin/magento module:status | grep -i graphql`
```

---
# Replacing it with nothing
File `composer.json`:
```json
{
    ...
    "replace": {
        "magento/module-marketplace": "*"
    },
    ...
}
```

---
# What don't you need
