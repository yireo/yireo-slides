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
# React
- Create React App / Webpack
- React source
- Redux state management
- Apollo client for GraphQL

---
# PWA Studio
- Buildpack
- Venia Concept theme
- Venia UI component library
- Peregrine
- UPWARD

---
# PWA Studio
- Buildpack
  - Wrapper for Webpack
- Venia Concept theme
  - Template for your own React source
- Venia UI component library
  - Redux state management
  - Apollo client for GraphQL
- Peregrine
  - Collection of hooks and more
- UPWARD

---
class: center, middle
### So ... UPWARD

---
class: center, middle
### Unified Progressive Web App Response Definition

---
# UPWARD
- Proxy between PWA & Magento
    - Or: A middle tier service layer between browser & server
    - **Unified Progressive Web App Response Definition**
- Mapping of properties, functions & data
- No state
- Defined in YAML

---
class: center, middle
### But what is doing UPWARD?

---
class: center, middle
### Benefits & downsides

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
### But what is doing UPWARD?

---
class: center, middle
### Running UPWARD

---
# UPWARD connectors
- NodeJS (for instance React or Vue)
- Magento UPWARD module
- Standalone PHP (for instance, Laravel or Symfony)

---
# Running UPWARD
- Development
  - Part of Buildpack
- Production
  - Node / UPWARD standalone
  - Node / Express
  - PHP / Magento module
  - PHP / something else

---
# Development
```bash
yarn create @magento/pwa
yarn watch
```

---
# Production: Node standalone
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

You can guarantee that `upward-js-server` remains running by using PM2

---
# Production: Node in Express
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

Note that there only needs to be 1 file in this new repository

---
# Running the Express server
Usage:
```js
node example-server.js
```

You can guarantee that `example-server.js` remains running by using PM2

---
# Production: Magento module
- Install and enable the module
- Configure the specification

---
# Install and enable
- `composer require magento/module-upward-connector`
- `bin/magento module:enable Magento_UpwardConnector`

---
# Configuring things
- **Stores > Configuration > General > Web > UPWARD PWA Configuration**
  - Example config: `/path/to/pwastudio/packages/venia-concept/dist/upward.yml`
- Make sure to build the PWA first (`yarn build`) and deploy it to production

---
class: center, middle
### But what is doing UPWARD?

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

See https://www.czettner.com/2020/02/14/magento-2-pwa-studio-ssr.html

---
# Mustache templates (1)
- `open-document.mst`
	- Beginning of HTML response, opening of `<head>`
- `open-body.mst`
	- Closing of `<head>`, opening of `<body>`
- `close-document.mst`
	- Closing of `<body>`

---
# Mustache templates (2)
Usage in other file (`example.mst`):
```html
{{> templates/open-document}}
  <title>{{ title }}</title>
{{> templates/open-body}}
  <b>Hello Template World!</b>
{{> templates/close-document}}
```

---
# Mustache templates (3)
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
# Mustache templates (4)
- `venia-ui/templates/generic-shell.mst`
- `venia-ui/templates/cmspage-shell.mst`
- `venia-ui/templates/product-shell.mst`
- `venia-ui/templates/category-shell.mst`

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
class: center, middle
### So in short, UPWARD uses its own specifications in YAML to jump from one part to another to do what ...?

---
class: center, middle
### But what is doing UPWARD?

---
# UPWARD and CSS requests
- PWA in browser requests a CSS file
- Request is forwarded from Nginx to UPWARD
- Request is handled by UPWARD
- Response is sent back from UPWARD to Nginx
- Response is sent back from Nginx to browser

Remember that UPWARD has *no state*, so no caching

---
# UPWARD and JS requests
- PWA in browser requests a JS file
- Request is forwarded from Nginx to UPWARD
- Request is handled by UPWARD
- Response is sent back from UPWARD to Nginx
- Response is sent back from Nginx to browser

Remember that UPWARD has *no state*, so no caching

---
# UPWARD and static requests
- PWA in browser requests any static file
- Request is forwarded from Nginx to UPWARD
- Request is handled by UPWARD
- Response is sent back from UPWARD to Nginx
- Response is sent back from Nginx to browser

Remember that UPWARD has *no state*, so no caching

---
class: center, middle
### If a proxy in between the browser and static files is not caching anything, performance is better if you remove the proxy.

---
class: center, middle
### In short: Do not use UPWARD for static files, but use Nginx instead

---
# UPWARD & GraphQL requests
- PWA in browser requests a JS file
- Request is forwarded from Nginx to UPWARD
- Request is handled by UPWARD
- Response is sent back from UPWARD to Nginx
- Response is sent back from Nginx to browser

Remember that UPWARD has *no state*, so no caching

---
class: center, middle
### If a proxy in between the browser and GraphQL is not caching anything, performance is better if you remove the proxy.

---
class: center, middle
### In short: Do not use UPWARD for GraphQL, but use Magento directly

---
# Venia without UPWARD
- Edit `index.js`
    - `const apiBase = new URL('https://m2.vega.yr/graphql').toString();`
- Cleanup
    - Remove `server.js`, `upward.yml`


---
class: center, middle
### My personal opinion: Do not use UPWARD in production, but use Nginx for this instead

---
class: center, middle
### Unless you want to do SSR (Server Side Rendering) with UPWARD ...

---
class: center, middle
### but there are other better solutions maycbe for that.

---
class: center, middle
### Is it useful in development?

---
# UPWARD in development
- Buildpack creates a dynamic hostname + SSL
- The same domain name is serving all requests
- No issues with CORS
  - Cross-Origin Resource Sharing

---
# Other CORS solutions
- Yireo CorsHack module
  - https://github.com/yireo-training/magento2-corshack
- SplashLab CorsRequests
  - https://github.com/splashlab/magento-2-cors-requests
- Heroku CORS Anywhere app

---
class: center, middle
### My personal opinion: You do not even need UPWARD in development, if you are solving the CORS problem differently

---
class: center, middle
### Disclaimer: This is just me speaking

---
class: center, middle
### Disclaimer: I'm not going to be a Magento Master 2020>

---
class: center, middle
### Thanks
