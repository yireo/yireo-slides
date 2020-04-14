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
# Total opportunities
- Add new endpoints
- Extending the Store Configuration
- Modify existing endpoints
  - DI interceptor plugins
- Testing
  - Integration tests
  - API Functional tests

---
{state: dark center middle}
github.com/yireo/Yireo_AdditionalEndpointsGraphQl

---
{state: dark center middle}
# Client-side GraphQL

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
# Vue example
```vue
export default {
  apollo: {
    cmsPage() {
      return {
        query: CMS_PAGE_QUERY,
        variables() {
          return { id: this.cmsPageId };
        }
        result (result) {
          this.updateCmsPage(result.data.cmsPage);
        }}}}}
```

---
{state: dark center middle}
# Beyond Magento

---
# E-commerce platforms supporting GQL
- Shopware: 3rd party plugin
- CommerceTools: Native
- BigCommerce: Native
- Shopify: Native
- Sylius: No
- WooCommerce: No
- Strapi: Native

---
# CMS platforms supporting GQL
- Contentful: Native
- GraphCMS: Native
- WordPress: 3rd party plugin
- Drupal: 3rd party plugin
- Prismic: Native
- (Gatsby)

---
# Other APIs supporting GQL
- GitHub
- GitLab
- FaunaDB

---
{state: dark center middle}
# Microservices

---
# Your own microservice
- Pick a programming language
- Pick a problem subset
- Write your own logic for this (using DDD, TDD?)
- Wrap this in an GraphQL API

---
# Programming language
- Node
  - Apollo, Relay, Prisma
- PHP
  - GraphQLite, Webonyx GraphQL
- Or any language
  - Java, Ruby, Python, Go, ...

---
# E-commerce services
- ElasticSearch
  - Third party project: GraphQL proxy
  - Do not use Magento to wrap ElasticSearch!
- PIMs
- ERP

---
### Ask yourself:
## Is GraphQL required? Or is REST just fine?

---
# More options
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
{state: dark center middle}
# GraphQL Mesh

---
# Challenges
- Bundling multiple APIs into single API
  - Schema stitching, schema proxies
- Maintaining all APIs across multiple networks
  - Versioning, client-management, proxies
- Performance
  - Caching (client-side, server-side), cache invalidation
  - Server Side Rendering

@todo: Picture of network (M2, ES, middleware, Contentful, inventory microservice)

---
# Apollo
- Apollo Client
- Apollo Server
- Apollo Federation

---
{state: dark center middle}
# Conclusion: Wrap all APIs with GraphQL

---
@todo: LoTR picture
{state: dark center middle}
# One API to rule them all
