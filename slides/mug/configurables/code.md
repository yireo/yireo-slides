class: center, middle
# Configurable Products
### MUG &prime;s Hertogenbosch

---
# Importeren van CP
* Eerst Simple Products aanmaken
    * `Mage_Catalog_Model_Product_Type::TYPE_SIMPLE`
* Dan Configurable Product aanmaken
    * `Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE`
* Dan mapping aanmaken

---
# Mapping tussen SP en CP
Altijd op basis van product attributen die zijn ingesteld 
als configureerbaar via **Attribute Management**.

```php
$blueSimpleProduct = Mage::getModel('catalog/product')->load(3);
$greenSimpleProduct = Mage::getModel('catalog/product')->load(8);
$configurableProduct = Mage::getModel('catalog/product')->load(21);

$colorAttribute = Mage::getModel('eav/entity_attribute')
    ->loadByCode('catalog_product', 'color');

$configurableProductsIds = array(3, 8); // array product IDs
$configurableAttributesData = array(); // volgende slide

$configurableProduct->setConfigurableProductsData($configurableProductsIds);
$configurableProduct->setConfigurableAttributesData($configurableAttributesData);
$configurableProduct->setCanSaveConfigurableAttributes(true);
```

---
# Mapping tussen SP en CP

```php
$configurableAttributesData[] = array(
    'id' => null,
    'label' => 'color', 
    'frontend_label' => 'Color',
    'attribute_id' => $colorAttribute->getId(),
    'attribute_code' => 'color',
    'values' => array(
        array(
            'label' => 'Blue',
            'value_index' => $blueSimpleProduct->getData('color'),
            'is_percent' => false,
            'pricing_value' => 10.99,
        ),
        array(
            'label' => 'Green',
            'value_index' => $greenSimpleProduct->getData('color'),
            'is_percent' => false,
            'pricing_value' => 11.99,
        ),
    ),
    'position' => 0,
);
```

---
# Oude mappings weg
Opschonen van tabel `catalog/product_super_attribute`
```php
$resource = Mage::getSingleton('core/resource');
$write = $resource->getConnection('core_write');
$table = $resource->getTableName('catalog/product_super_attribute');
$write->delete($table, 'product_id = ' . $product->getId());
```

---
# Performance bij import
* Zet indices op "Manual"
* Caching aan
* Flat catalog uit
* MySQL tuning

---
# Gemompel
* Performance van CP wordt bepaald door:
    * Inladen van gerelateerde SP
    * Mapping tussen SP en attributen
* Wat als die mapping wordt gecached?
    * Alleen op categorie paginas
    * Include visible attributes in mapping

---
class: center, middle
### thanks for all the fish
