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
# Remote online training
- Magento PWA Studio development
- Vue Storefront development
- GraphQL API microservice development (PHP)
- React / Redux / Apollo / SSR
- Vue / Vuex / Apollo / SSR

Link: yireo.com/events

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
# GraphQL
- A flexible way
  - (developer-oriented, performant, easy-to-understand)
~ ... to fetch data
  - (assuming that the server-side API supports GraphQL)
~ ... and use these JSON data
  - (in client-side environments, based on whatever you want)

---
{state: dark center middle}
# GraphQL provides the neck in headless
#### (Magento is the body, the frontend is the head)

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
  - Focused on enterprise, which is leading to market shift

---
{state: dark}
# Magento 2 in short (2/2)
~ Magento PWA Studio development stack
  - Introduced with Magento 2.3
  - Based on React, Redux, Apollo Client and GraphQL
  - Offering Buildpack, Peregrine, Venia Concept, Venia UI, UPWARD
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
# Magento 2 module
- `etc/module.xml`
- `registration.php`
- `composer.json`
- `etc/schema.graphqls`
- `Model/Resolver/Hello.php`

---
# Magento 2 `etc/schema.graphqls`
```js
type Query {
    hello (
        name: String @doc(description: "Who to greet?")
    ): Hello
    @resolver(class: "Yireo\\Example\\Model\\Resolver\\Hello")
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
namespace Yireo\Example\Model\Resolver;
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
# Extending Magento 2 GraphQL
- Add new endpoints
- Extending the Store Configuration
- Modifying / extending existing endpoints
  - Your own `etc/schema.graphqls`
  - DI interceptor plugins
- Testing
  - Integration tests
  - API Functional tests

---
{state: dark center middle}
## Examples
#### github.com/yireo/Yireo_AdditionalEndpointsGraphQl/
#### github.com/yireo-training/

---
{state: dark center middle}
# Client-side GraphQL

---
# GraphQL clients
- GraphiQL
  - ChromeiQL, GraphiQL web-version, desktop apps

---
<img src="/images/meetup-graphql/graphiql-screenshot.png" />

---
# GraphQL clients
- GraphiQL
  - ChromeiQL, GraphiQL web-version, desktop apps
- Shell
  - curl, GraphQL CLI

---
<img src="/images/meetup-graphql/graphql-cli.gif" />


---
# GraphQL clients
- GraphiQL
  - ChromeiQL, GraphiQL web-version, desktop apps
- Shell
  - curl, GraphQL CLI
- JavaScript
  - Axios, Apollo Client, Prisma, Apollo


---
# Usage of GraphQL
- React
  - Magento PWA Studio, FrontCommerce, DEITY, React Storefront, Reaction
- Vue
  - Vue Storefront
- jQuery
  - And thus in original Magento 2 frontend with Knockout & Require
- PHP client
  - Guzzle HttpClient, for instance in WordPress, Laravel or Symfony

---
# React example
```js
import gql from 'graphql-tag';
import { useQuery } from '@apollo/react-hooks';
import PRODUCT_QUERY from 'queries/product_info.graphql';

const ProductContainer = ({ props }) => {
  const { loading, error, data } = useQuery(PRODUCT_QUERY, props);
  if (loading) return 'Loading...';
  if (error) return `Error! ${error.message}`;
  return (
    <ProductView product={data}/>
  );
}
```


---
# Vue example
```vue
export default {
  apollo: {
    productPage() {
      return {
        query: PRODUCT_QUERY,
        variables() {
          return { id: this.productId };
        }
        result (result) {
          this.updateProductPage(result.data.product);
        }}}}}
```

@todo: Picture of Browser (React/Vue) and server

---
# PHP example
```php
$response = $this->client->post('/graphql', [
        'form_params' => [
            'query' => PRODUCT_QUERY,
            'variables' => [
                'id' => $productId
            ]
        ]
    ]);

echo $response->getBody()->getContents();
```

@todo: Picture of PHP client, browser and server

---
{state: dark center middle}
## Headless means freedom of choice

---
{state: dark}
# Freedom of choice
~ To make any frontend capable of consuming GraphQL APIs
~ To replace parts of Magento with other services
~ To replace Magento

---
{state: dark center middle}
# Beyond Magento

---
# E-commerce platforms supporting GQL

<table>
<tr><td>Magento</td><td>Native</td></tr>
<tr><td>CommerceTools</td><td>Native</td></tr>
<tr><td>BigCommerce</td><td>Native</td></tr>
<tr><td>Shopify</td><td>Native</td></tr>
<tr><td>Shopware</td><td>3rd party plugin</td></tr>
<tr><td>Sylius</td><td>No</td></tr>
<tr><td>WooCommerce</td><td>No</td></tr>
<tr><td>...</td><td></td></tr>
</table>

---
# CMS platforms supporting GQL

<table>
<tr><td>Contentful</td><td>Native</td></tr>
<tr><td>GraphCMS</td><td>Native</td></tr>
<tr><td>Strapi</td><td>Native</td></tr>
<tr><td>Prismic</td><td>Native</td></tr>
<tr><td>Gatsby</td><td>Native</td></tr>
<tr><td>WordPress</td><td>3rd party plugin</td></tr>
<tr><td>Drupal</td><td>3rd party plugin</td></tr>
<tr><td>...</td><td></td></tr>
</table>

---
# Other APIs supporting GQL
- GitHub
- GitLab
- FaunaDB

@todo: Picture of CMS, E-commerce, React/Vue

---
{state: dark center middle}
# Microservices

---
# Your own microservice
~ Pick a programming language
~ Pick a problem subset (service)
~ Write your own logic for this (using DDD, TDD?)
~ Wrap this in an GraphQL API

---
# Pick a programming language
~ Node
  - Apollo, Relay, Prisma
~ PHP
  - GraphQLite, Webonyx GraphQL
~ Or any language
  - Java, Ruby, Python, Go, ...

---
# Pick a service to add as microservice
~ ElasticSearch
  - Third party project: GraphQL proxy
  - Do not use Magento to wrap ElasticSearch because its slow
~ Product Information Management (PIM)
  - Handy in managing product information
  - Often slow in access
~ Enterprise Resource Planning (ERP)
  - Handy in managing all kinds of information
  - Often slow in access

---
@todo: Picture M2 with ElasticSearch and feed to React/Vue

---
# Or build your own microservice
- Caching service
- Price calculation
- Alternative inventory & stock
- VAT verification
- Email verification
- Dealers / retailer information
- Complex product options
- Promos and advertizing
- Image optimization
- Product image provider

---
@todo: Picture of CMS, E-commerce, stock inventory, image processing, React/Vue, ElasticSearch with GQL microservice

---
{state: dark center middle}
# Introducing GraphQL Mesh

---
# GraphQL Mesh
- Created by The Guild
- Automatic discovery of backend API type
  - Swagger, OpenAPI, json-schema, SOAP, Federated GraphQL, etc
- Turns it into plain GraphQL

See: https://graphql-mesh.com/

---
@todo: Picture of network (M2, ES, middleware, Contentful, inventory microservice) and GraphQL Mesh

---
@todo: Picture of CMS, E-commerce, stock inventory, image processing, React/Vue

---
### Ask yourself:
## Is GraphQL required? Or is REST just fine?

---
# Why use GraphQL everywhere?
~ Consolidate API syntax
  - All systems offer the same API language (GraphQL)
~ Real headless frontends
  - No knowledge needed on backend service
~ Easier refactoring
  - Well, at least in theory

---
# Challenges with microservice management
~ Bundling multiple APIs into single API
  - GraphQL schema stitching, GraphQL schema proxies
~ Maintaining all APIs across multiple networks
  - Versioning, client-management, proxies
~ Performance
  - Caching (client-side, server-side), cache invalidation
  - Server Side Rendering

---
# Apollo
- Apollo Client
- Apollo Server
- **Apollo Federation**

---
{state: dark center middle}
# Turn everything into GraphQL

---
@todo: LoTR picture
{state: dark center middle}
# One API to rule them all
