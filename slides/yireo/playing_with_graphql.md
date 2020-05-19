layout: true
<div class="slide-heading">Playing with GraphQL</div>
<div class="slide-footer"><span>Yireo - Opening Up Technology</span></div>

---
class: center, middle
# Playing with
### Magento 2 GraphQL

---
# Jisse Reitsma
~ From the Netherlands
~ Founder of Yireo
~ Extension developer
~ Trainer in Magento 2, React, Vue
~ Creator of MageTestFest & Reacticon
~ Magento Master 2017 & 2018 & 2019 Mover
~ Member of ExtDN.org

---
class: center, middle
### GraphQL Basics

---
# GraphQL basics
- A better API than REST
- Fetch only what you need and all that you need
    - Prevents overfetching
- Bundle multiple requests in one
- Schemas as a single source of truth
    - Schema stitching

---
# GraphQL clients
- Shell clients
- GraphiQL clients
- PHP clients
- Node clients

---
# Shell clients
- CURL request from shell
- [GraphQL CLI](https://github.com/Urigo/graphql-cli)

^^Use [jq](https://stedolan.github.io/jq/) to parse the JSON results

---
# Shell test
```bash
curl -X POST \
    -H "Content-Type: application/json" \
    -d '{"query": "{products(search: \"Hood\") {
        items {id,sku,name},
        filters {name:name}
    }}"}' \
    https://magento23.yr/graphql
```

---
# GraphiQL clients
- In browser
    - ChromeiQL
    - Included in PWA Studio
- In Electron
- In AppImage
    - GraphiQL.app (https://github.com/skevy/graphiql-app)

---
class: center, middle
### Queries & mutations

---
# Products Query
```graphql
{
  products(search: "Hood") {
    items {
      id
      sku
      name
      url_rewrites {
        url
        parameters {
          name
          value
        }
      }
    },
    filters {
      name:name
    }
  }
}
```

---
# CMS Query
```graphql
{
  cmsPage(id:2) {
    title
    content
  }

  cmsBlocks(identifiers: ["hello-world"]) {
    items {
      identifier
    }
  }
}
```

---
# URL Query
```graphql
{
  urlResolver(url: "laser-cut-stretch-belt.html") {
    type
    id
    canonical_url
  }
}
```

---
# Cart Query
```graphql
mutation {
  createEmptyCart
}
```

```graphql
query myCartQuery{
  cart(cart_id: "1WxKm8WUm3uFKXLlHXezew5WREfVRPAn") {
    cart_id
    items {
      id
      qty
    }
    billing_address {
      firstname
      lastname
      postcode
      }
  }
}
```

---
class: center, middle
### Adding GraphQL to React

---
# Putting GraphQL in React
```bash
npx create-react-app apollo-example
```

And then:
```bash
cd apollo-example
yarn add apollo-boost react-apollo graphql graphql-tag
```

And go:
```bash
yarn start
```

---
# File `src/apollo.js`
```react
import { ApolloClient } from "apollo-client";
import { HttpLink } from "apollo-link-http";
import { InMemoryCache } from "apollo-cache-inmemory";

const httpLink = new HttpLink({ uri: "http://m2.sirius.yr/graphql" });

const client = new ApolloClient({
  link: httpLink,
  cache: new InMemoryCache()
});

export default client;
```

---
# File `src/index.js`
```react
import React from "react";
import ReactDOM from "react-dom";
import "./index.css";
import App from "./App";
import * as serviceWorker from "./serviceWorker";
import { ApolloProvider } from "react-apollo";
import client from './apollo';

ReactDOM.render(
  <React.StrictMode>
    <ApolloProvider client={client}>
      <App />
    </ApolloProvider>
  </React.StrictMode>,
  document.getElementById("root")
);

serviceWorker.unregister();
```

---
# File `src/Dealers.js` (1)
```react
import React from "react";
import { useQuery } from '@apollo/react-hooks';
import gql from 'graphql-tag';

const DEALERS_QUERY = gql`
{
    dealers {
      items {
        id
        name
        address
      }
    }
  }
`
...
```

---
# File `src/Dealers.js` (2)
```react
...
const Dealers = () => {
    const { loading, error, data } = useQuery(DEALERS_QUERY);

    if (loading) return 'Loading...';
    if (error) return `Error! ${error.message}`;

    return (
        <ul>
            {data.items.map(item => (
                <li key={item.id}>{item.name} {item.address}</li>
            ))}
        </ul>
    )
}

export default Dealers
```

---
# File `src/App.js`
```react
import React from 'react';
import './App.css';
import Dealers from './Dealers';

function App() {
  return (
    <div className="App">
      <Dealers/>
    </div>
  );
}

export default App;
```

---
# Fix CORS headers
In Magento 2:
```bash
composer require yireo-training/magento2-corshack
bin/magento module:enable Yireo_CorsHack
```

^^Link: https://github.com/yireo-training/magento2-corshack

---
class: center, middle
### Extending GraphQL

---
# Yireo Example Dealers module
- Modules
  - Core module
  - Admin Panel module
  - CLI module
  - Frontend module
  - GraphQL module
  - Sample Data module

^^Link: https://github.com/yireo-training/magento2-example-dealers

---
# Yireo Additional Endpoints module
- Endpoints
  - productById
  - productBySku
  - cmsBlock
  - cmsPages
  - cmsWidget
  - validateCustomerToken

^^Link: https://github.com/yireo/Yireo_AdditionalEndpointsGraphQl


---
# Yireo GraphQlRateLimiting module
- Open source
- Implements rate limiting for GraphQL

^^Link: https://github.com/yireo/Yireo_GraphQlRateLimiting

---
# Yireo CustomGraphQlQueryLimiter module
- Modify allowed query depth and complexity

^^Link: https://github.com/yireo/Yireo_CustomGraphQlQueryLimiter


---
class: center, middle
# Thanks!
### Any questions?
