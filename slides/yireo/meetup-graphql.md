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
{state: dark}
# Magento 2 in short
- Magento 1 and Magento 2 are different products
  - Magento 1
- Most popular open source cart of today
  - Maybe not tomorrow
- Taken over by Adobe
- Magento PWA Studio development stack (since Magento 2.3)
- Magento GraphQL API (since Magento 2.3)
