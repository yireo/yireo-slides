layout: true
<div class="slide-heading">Explaining UPWARD properly - Ahmedabad Magento Meetup</div>
<div class="slide-footer"><span>Yireo - Opening Up Technology</span></div>

---
class: center, middle
# Explaining UPWARD properly
### a Magento PWA Studio saga

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
### So ... UPWARD

---
# UPWARD
- Proxy between PWA & Magento
    - Or: A middle tier service layer between browser & server
    - **Unified Progressive Web App Response Definition**
- Mapping of properties, functions & data
- No state
- Defined in YAML

---
# UPWARD connectors
- NodeJS (for instance React or Vue)
- Magento UPWARD module
- Standalone PHP (for instance, Laravel or Symfony)

---
# Benefits of UPWARD
- Local SSL certificate
    - Ability to work with serviceworker
- Local domain
- Easy deployment to non-Node Magento hosting
    - Using the UPWARD Magento/PHP module

---
# Downsides of UPWARD
- Potentially slower
    - Resources are routed through UPWARD (including static files)
    - Potential fixes using webserver configuration
- Complexer to understand

---
class: center, middle
### Running UPWARD

---
# Running UPWARD
- Development
  - Part of Buildpack
- Production
  - Via Node standalone
  - Or via Node in Express (recommended)
  - Or via PHP (recommended)

---
# Via Node standalone
Install globally:
```bash
npm install -g @magento/upward-js
```

And then run:
```bash
UPWARD_JS_UPWARD_PATH=/abc/upward.yml \
UPWARD_JS_BIND_LOCAL=1 \
UPWARD_JS_LOG_URL=1 \
upward-js-server
```

^^You can guarantee that `upward-js-server` remains running by using PM2

---
# Via Node in Express
Create a new project (`yarn init`) and add to it:
```bash
yarn add @magento/upward-js express
```

---
# Create an Express server
File `example-express/example-server.js`:
```js
const { createUpwardServer } = require('@magento/upward-js');

async function serve() {
  await createUpwardServer({
    port: 8000,
    bindLocal: true,
    logUrl: true,
    upwardPath: '/abc/upward.yml'
  });
}

serve();
```

^^Note that there only needs to be 1 file in this new repository

---
# Running the Express server
Usage:
```js
node example-server.js
```

^^You can guarantee that `example-server.js` remains running by using PM2

---
# UPWARD PHP for Magento 2
- Install and enable the module
    - `composer require magento/module-upward-connector`
    - `bin/magento module:enable Magento_UpwardConnector`
- Configure the specification
    - **Stores > Configuration > General > Web > UPWARD PWA Configuration**
    - Example config: `/path/to/pwastudio/packages/venia-concept/dist/upward.yml`
    - Make sure to build the PWA first (`yarn build`) and deploy it to production
- Technical working
    - Adds a new area `pwa`
    - Plugs into `AreaList::getCodeByFrontname()` to change the area into `pwa`

???
`Magento\Framework\App\AreaList::getCodeByFrontname` determines the `area` code (`adminhtml`, `frontend` and now also `pwa`) by inspecting the `frontName`. This is used by `Magento\Framework\App\Http::launch()` to set the current area code in the global state (`Magento\Framework\App\State`) and to load all DI preferences from it, resulting in area-specific routes, controllers, observers and everything. The plugin rewrite sets the area to `pwa` for all routes (excluding some that you can configure yourself).

Next, in the `pwa` area the regular Front Controller is rewritten (using a preference override) to an UPWARD Front Controller (`Magento\UpwardConnector\Controller\Upward`). This new Front Controller dispatches every request (including static resources) to an UPWARD controller `Magento\Upward\Controller`, that is initialized using the YAML file configured in the Magento Store Configuration. This UPWARD controller resolves the UPWARD definition from YAML and handles it correspondingly via resolvers (`Magento\Upward\Resolver`): Direct files are read , Mustache templates are parsed, proxies fetch remote content, etcetera.

And the final result from any resolver is sent back to the client.

---
class: center, middle
### UPWARD YAML

---
# Which YAML file?
- Use the YAML file distributed by Venia
  - `dist/upward.yml`
- Custom create your own YAML
  - `upward-hello.yml`

---
# upward-hello.yml
```yaml
status: 200
headers:
  inline:
    content-type:
      inline: text/html
body:
  inline: 'Hello World'
```

See: https://itnext.io/magento-pwa-studio-what-is-upward-acf450fbee3e

---
# Rendering a CMS Page
```yaml
resource:
  when:
    - matches: urlResolver.type
      pattern: 'CMS_PAGE'
      use:
        inline:
          model: cmsPage
          name: cmsPage.title
          entityTypeName:
            inline: "Page"
          template: '../venia-ui/templates/cmspage-shell.mst'
```

^^See https://www.czettner.com/2020/02/14/magento-2-pwa-studio-ssr.html

---
# Mustache templates (1)
- `open-document.mst`
	- Beginning of HTML response, opening of `<head>`
- `open-body.mst`
	- Closing of `<head>`, opening of `<body>`
- `close-document.mst`
	- Closing of `<body>`

Usage in other file (`example.mst`):
```html
{{> templates/open-document}}
  <title>{{ title }}</title>
{{> templates/open-body}}
  <b>Hello Template World!</b>
{{> templates/close-document}}
```

---
# Mustache templates (2)
File `venia-ui/templates/cmspage-shell.mst`:
```js
{{> templates/open-document}}
    {{#model}}
        <title>{{title}} - My awesome site</title>
        <meta name="title" content="{{meta_title}}">
        <meta name="keywords" content="{{meta_keywords}}">
        <meta name="description" content="{{meta_description}}">
    {{/model}}
  {{> templates/open-body }}
  {{> templates/default-initial-contents }}
  {{> templates/seed-bundles}}
{{> templates/close-document}}
```

---
# Mustache templates (3)
- `venia-ui/templates/generic-shell.mst`
- `venia-ui/templates/cmspage-shell.mst`
- `venia-ui/templates/product-shell.mst`
- `venia-ui/templates/category-shell.mst`

---
# UPWARD Resolvers (1)
- InlineResolver
	- Content is part of YAML
- FileResolver
	- Content is read from file
- ServiceResolver
	- Content is derived from GraphQL backend
- TemplateResolver
	- Content is read from a Mustache template file

---
# UPWARD Resolvers (2)
- ConditionalResolver
	- Choices being made based on `when` and `matches`
- ProxyResolver
	- Proxy between PWA and backend (like REST)
- DirectoryResolver
	- Proxying to local filesystem (like with assets)
- UrlResolver
	- Building URLs

---
# FileResolver
Example snipper from UPWARD YAML:
```yaml
query:
  resolver: file
  file:
    resolver: inline
    inline: './productDetail.graphql'
  encoding:
    resolver: inline
    inline: 'utf-8'
```

^^The property `query` is filled with the contents of the GraphQL file

---
# UPWARD and SSR
- FileResolver
	- Generate static files for all pages
	- Serve static files via UPWARD
- TemplateResolver
	- Generate dynamic files based on Mustache (`*.mts`)
- Not using UPWARD, but using Nginx

---
class: center, middle
### Other points

---
# Running Venia without UPWARD
- Configure webserver to route directly to all static files
- Make sure Magento is running on HTTPS
- Edit `index.js`
    - `const apiBase = new URL('https://m2.vega.yr/graphql').toString();`
- Cleanup
    - `server.js`, `upward.yml`

???
In a live environment, you could decide to drop UPWARD and simply connect the PWA directly to Magento. If you would like a middleware layer with caching abilities, use Apollo Server (or something similar instead).

---
# Alternatives to UPWARD
- Express Server
  - Connect other services (WordPress, ElasticSearch)
- Apollo Server
  - Connect other GraphQL resources (schema stitching)

^^Or combine add both UPWARD and Apollo to your custom Express server
