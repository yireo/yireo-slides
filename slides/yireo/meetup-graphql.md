{state: main middle}
{background-image: meetup-poznan/saddhu.jpg}
# GraphQL, Magento and React
## Because GraphQL is da bomb
#### by Jisse Reitsma (Yireo)

---
{state: speaker}
{background-image: generic/jisse.jpg}
# Jisse Reitsma
- Founder of Yireo
- Trainer of developers
- Creator of MageTestFest (2017, 2018)
- Creator of Reacticon (2018 x2)
- Creator of Reacticon v3 (June 2020)
- Magento Master 2017/2018/2019 Mover
- Member of ExtDN (Magento Extension Developer Network)

---
{state: dark center middle}
# GraphQL, Magento and React

---
{state: dark center middle}
### Because GraphQL is da bomb

---
{state: dark center middle}
### Because GraphQL is viral

---
{state: dark center middle}
### Because GraphQL is da bomb

---
{state: dark center middle}
# GraphQL in a few minutes

---
{state: dark}
# GraphQL in short
- Queries, mutations & fragments

---
# A simple GraphQL query
```graphql
{
  cmsPage(id:2) {
    title
    content
  }
}
```

---
# A simple JSON response
```json
{
  "data": {
    "cmsPage": {
      "title": "Home page",
      "content": "<p>Hello World</p>\r\n"
    }
  }
}
```

---
{state: dark}
# GraphQL in short
- Queries, mutations & fragments
- Underfetching instead of overfetching

---
# Underfetching (1/2)
```graphql
{
  products(search: "Hood") {
    items {
      id
      sku
      name
      meta_title
      meta_keyword
    }
  }
}
```

---
# Underfetching (2/2)
```graphql
{
  products(search: "Hood") {
    items {
      id
      sku
      name
    }
  }
}
```

---
{state: dark}
# GraphQL in short
- Queries, mutations & fragments
- Underfetching instead of overfetching
- Multiple subqueries

---
{state: dark}
# Multiple subqueries (1/2)
```graphql
{
  products(search: "Hood") {
    items {
      categories {
        products {
          items {
            sku
          }
        }
      }
    }
  }
}
```

---
{state: dark}
# Multiple subqueries (2/2)
```graphql
{
  products(search: "Hood") {
    items {
      sku
    }
  }
  cmsPage(id:2) {
    title
    content
  }
}
```

---
{state: dark center middle}
# Magento in a few minutes

---
{state: dark}
# Magento 2 in short (1/2)
~ Popular open source cart
  - Most popular today, maybe not tomorrow
  - Known for its modularity, extensibility & bizar complexity
~ Magento 1 and Magento 2 are different products
  - Magento 1 reaches End-Of-Life in June 2020
~ Taken over by Adobe
  - Commercial product renamed to Adobe Commerce (Cloud)

---
{state: dark}
# Magento 2 in short (2/2)
~ Magento PWA Studio development stack
  - Introduced with Magento 2.3
  - Buildpack, Peregrine, Venia Concept, Venia UI, UPWARD
~ Magento GraphQL API
  - Introduced Magento 2.3
  - Complete coverage expected with Magento 2.4
  - Extensible using Magento 2 extensions

---
# Sample custom query
```graphql
{
  hello(name:"World") {
  	name
	  result
  }
}
```

---
# Magento 2 `etc/schema.graphqls`
```js
type Query {
    hello (
        name: String @doc(description: "Who to greet?")
    ): Hello
    @resolver(class: "Yireo\\ExampleGraphQl\\Model\\Resolver\\Hello")
    @doc(description: "Simple Hello World example")
}
type Hello @doc(description: "Hello answer") {
    name: String @doc(description: "Original input")
    result: String @doc(description: "Result")
}
```

---
# Magento 2 Resolver class
```php
namespace Yireo\ExampleGraphQl\Model\Resolver;
use /** **/;
class Hello implements ResolverInterface
{
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        return [
            'name' => $args['name'],
            'result' => 'Hello, ' . ucfirst($args['name'])
        ];
    }
}
```

---
{state: dark center middle}
github.com/yireo/Yireo_AdditionalEndpointsGraphQl

---
# Clients
- GraphiQL
  - ChromeiQL, GraphiQL web-version, desktop apps
