{state: main}
{background-image: mm18uk/background-mm.png}
# Connecting GraphQL
## to your own React project

---
{state: speaker}
{background-image: mm18it/jisse2.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of Magento 2 developers
~ Creator of MageTestFest & Reacticon
~ Member of ExtDN.org
~ Magento Master 2017 & 2018 Mover
~ Not really good at Adobe Photoshop

???
My slides might have some Photoshop magic in it

---
{state: main}
{background-image: mm18de/extdn.jpg}

---
{state: divider divider-center divider-bold dark}
{background-image: mm18uk/graveyard.jpg}
# REST in peace
## Because GraphQL is better

???
GraphQL predictive API, bundling numerous API requests in single call

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/planets.jpg}
# Different worlds

---
{state: divider divider-center divider-bold}
{background-image: mm18hr/eu-parliament.png}
# Monolithic Magento

???
so why are we limiting ourselves

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/magneto.jpg}

???
This arrogant bastard thinks he should lead the charge. Who dictates how we build shops.
So with some Photoshop skills we can maybe improve this.

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/magneto-off.jpg}

???
let's not replace it with something short-sighted

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/magneto-asay.jpg}

???
but instead use something that sticks for the upcoming years
Matt Asay

---
{state: blank}

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/knockout.jpg}

???
So let's cut her head as well

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/knockout-off.jpg}

???
... and keep the important parts (gesture with the hands) ... Whoops ....

---
{state: blank}

---
# Current status of Magento
~ You are using Magento 2.1 or Magento 2.2
~ Magento 2.3 is coming in Q4 2018 (?)
~ With GraphQL support
~ With PWA Studio (?)
~ Without support for checkout / cart (?)
~ Magento 2.4 will include everything

---
# GraphQL
~ Flexible API
~ Predictive API

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/magneto-hybrid.jpg}
# Hybrid solutions

???
... to get ready now with GraphQL

---
# Hybrid solutions
~ PWA Studio for catalog, normal shop for checkout
~ Stand-alone React satellites that lead back to M2 shop
~ Replacing UiComponents with small React widgets
~ Like me, just playing around with Magento 2.3 + GraphQL + React

???
Story telling, campaigns, single product promotion

---
{state: main}
{background-image: mm18uk/background-mm.png}
# Magento 2.3 setup

---
# Magento 2.3 setup
```bash
git clone git@github.com:magento/magento2.git
git checkout 2.3-develop
cd 2.3-develop/
composer install
```
or
```bash
composer create-project \
    --repository=https://repo.magento.com/ \
    magento/project-community-edition=2.3.* \
    --stability=beta
```

---
# Magento 2.3 setup
~ Install Magento 2.3
~ Add sample data (the GitHub procedure)
~ Run production mode because of exception handling
~ Run developer mode because of GraphQl Predictive API
~ My destination URL: https://magento23.yr

???
Production mode: exceptions are written to logs, which easier to debug

---
# Modify .htaccess
```
<IfModule mod_headers.c>
    Header set Access-Control-Allow-Origin "http://localhost:3000"
    Header set Access-Control-Allow-Headers "Content-Type"
</IfModule>
```

~ Or use [Yireo_CorsHack](https://github.com/yireo-training/magento2-corshack) for this

---
{state: main}
{background-image: mm18uk/background-mm.png}
# Let's play with GraphQL

---
# Hello Graphql
```
{
  products(search: "Hood") {
    items {
      id
      sku
      name
    },
    filters {
      name:name
    }
  }
}
```

---
# GraphQL clients
- Shell command
- GraphiQL client
- React client
    - Axios
    - Apollo
    - Vulcan (full-stack Meteor-based)

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

???
Query is still the same but compressed a bit for readability

---
# GraphiQL
- In browser
- In Electron
- In AppImage

I used GraphiQL.app (https://github.com/skevy/graphiql-app)

---
{background-image: mm18uk/graphiql-client.png}

???
My presentation deals with 1 single query, 1 single output, and focuses on which clients to use

---
{state: main}
{background-image: mm18uk/background-mm.png}
# Add React to the mix

---
# Let's create a React app!
```
create-react-app mm18uk-app1
cd mm18uk-app1/
npm start
```

And browse to http://localhost:3000/

---
{background-image: mm18uk/react-default.png}

---
{state: main}
{background-image: mm18uk/background-mm.png}
# Axios (proof of concept)

---
# Axios client (1 of 2)
File `src/index.js`:
```js
import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';

import axios from 'axios';

const axiosClient = axios.create({
    baseURL: "https://magento23.yr/graphql",
});

```

---
# Axios client (2 of 2)
File `src/index.js`:
```js
const SAMPLE_QUERY = `{products(search: "Hood") {
items {id,sku,name}, filters {name:name}
}}`;

axiosClient
    .post('', {
        query: SAMPLE_QUERY
    })
    .then(result => console.log(result.data.data.products));

ReactDOM.render(<App/>, document.getElementById('root'));
```

???
Note that HTTP OPTIONS request (required for CORS) is not supported yet by Magento GraphQL API

---
# Little bug with OPTIONS
Magento file `index.php`:
```php
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    die();
}
```

Or use Yireo_CorsHack for this

---
{state: main}
{background-image: mm18uk/background-mm.png}
# Axios components

---
# And now with real components
- App
- ProductList

---
# Or even
- App
- ProductListContainer
- ProductList
- Product
- ProductLink
- ProductMedia

---
# Axios-driven component (1 of 2)
```js
import React from 'react';
import axios from 'axios';

export default class ProductList extends React.Component {
    state = { products: [] }
    componentDidMount() { ... }
    render() {
        return (
            <ul>
                { this.state.products.map(product => 
                    <li key={product.id}>{product.sku} {product.name}</li>)
                }
            </ul>
        )
    }
}
```

---
# Axios-driven component (2 of 2)
```js
    ...
    componentDidMount() {
        const SAMPLE_QUERY = `{products(search: "Hood") {
            items {id,sku,name}, filters {name:name}}}`;
        const axiosClient = axios.create({
            baseURL: "https://magento23.yr/graphql",
        });

        axiosClient.post('', {
            query: SAMPLE_QUERY
        }).then(result => {
            const products = result.data.data.products.items;
            this.setState({ products });
        })
    }
    ...
}
```

---
{background-image: mm18uk/react-list.png}

---
# Not reusable
It's hard to reuse the same Axios client in multiple components

---
# Tight binding between state & view
~ Solution: Use Container component + Presentational component

---
{state: main}
{background-image: mm18uk/background-mm.png}
# A better approach: Apollo

---
# A better approach: Apollo Client
```js
npm install apollo-boost react-apollo graphql-tag graphql --save
```
Follow procedure of Apollo docs

???
ApolloClient uses its own Redux store underneath

---
# Apollo Client architecture
~ `ApolloClient` is added to `ApolloProvider` as a property
~ `ApolloProvider` is wrapped around `App`
~ `ProductList` uses a `Query` component to query GraphQL

---
{state: blank}

---
{state: main}
{background-image: mm18uk/background-mm.png}
# Conclusion
Once you have a Magento 2.3 development environment, <br/>you can expose catalog data via GraphQL and start building in React

---
# Bonus slide
~ Reacticon (October 4th 2018)
~ Mārtiņš Saukums: VueJS component in M2 frontend
~ Jisse Reitsma: [ReactJS component in M2 frontend](https://github.com/yireo-training/Yireo_ReactMinicart)

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/magneto.jpg}
# Magento 2.3 will be there soon

---
{state: divider divider-center divider-bold}
{background-image: mm18uk/gamble.jpg}
# Start playing with GraphQL
### @jissereitsma / jisse@yireo.com

---
# Bonus video: What we do with Knockout
<video width="100%" height="100%" style="width:100%;height:100%;" controls>
  <source data-src="/images/mm18it/cat.webm" type="video/webm">
Your browser does not support the video tag.
</video>
