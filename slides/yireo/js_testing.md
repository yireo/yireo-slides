{state: main}
{background-image: mm18it/background-venice.jpg}
# What to test in JS?
## A humble overview of JS testing techniques

---
{state: speaker}
{background-image: mm18it/jisse2.jpg}
# Jisse Reitsma
~ Founder of Yireo
~ Trainer of M2 devs
~ Creator of MageTestFest & Reacticon
~ Member of ExtDN.org
~ Magento Master 2017 & 2018 Mover
~ A simple Dutch boy

---
# Fundamentals
~ No inline JS code (?)
~ Move logic to separate JS components
~ Use RequireJS to load dependencies
~ Pass HTML identifiers as configuration (JSON)

---
# Levels
~ **Unit**: Jasmine, Mocha, QUnit
~ **Integration**: RequireJS
~ **Functional**: MFTF
~ **End-to-end**: Selenium, Nightwatch.js

???
Unit tests: Pure functions. Integration tests: Done with same tools as unit tests, but you can now use RequireJS to not load mocks but actual other libraries. We're not going to focus on end-to-end testing in this talk.

---
{state: divider divider-center divider-bold}
{background-image: mm18it/doors-game-show.jpg}
# Diving into the tools

---
{state: divider divider-center divider-bold}
{background-image: mm18it/shell-game.jpg}
# How to make a choice?

---
# Which environment?
- Regular webbrowser
- PhantomJS browser
- Node CLI
- Rhino CLI

---
# Testing frameworks
- Jasmine
- MochaJS
- NodeUnit
- Tape
- CasperJS
- Jest
- Intern
- QUnit

???
Testing frameworks most commonly provide a `test()` function and `setup()` function.

---
# Assertion libraries
- Chai
- Should.js
- Expect.js
- NodeJS `assert()`
- power-assert
- assert-plus
- unexpected
- better-assert

???
Assertion libraries most commonly provide a `assert()` function.

---
# Test runners
- Karma
- (Tape)
- Ava

---
# Other tools
- Sinon: Mocking & spying library
- ESLint: Linting your JS code
- Mockjax: Mocking AJAX requests

---
{state: divider divider-center divider-bold}
{background-image: mm18it/david-is-scared.jpg}
# Could you repeat that?

---
{state: divider divider-center divider-bold}
{background-image: mm18it/traffic-in-india.png}
# Find your way

---
{state: divider}
<div class="heading"><img src="/images/mm18it/jasmine.png" /></div>
# Jasmine basics

---
# Getting started with Jasmine
Installing packages:
```bash
$ npm install -g jasmine-node
$ npm install -g yo
$ npm install -g generator-jasmine
```
Creating a Jasmine skeleton:
```bash
$ yo jasmine
```

Files:
- `test/index.html`
- `test/spec/test.js`

???
Yeoman project generator

Open up HTML file to run test

---
{state: divider}
<div class="heading"><img src="/images/mm18it/karma.svg" /></div>
# Adding Karma

---
# Adding Karma
Installing packages:
```bash
$ npm install -g karma
$ npm install -g generator-karma
$ npm install karma-chrome-launcher
```

Creating a Karma/Jasmine skeleton
```bash
$ yo karma --test-framework=jasmine
```

---
# Karma config for Jasmine
File `karma.conf.js`:
```js
module.exports = function(config) {
  'use strict';
  config.set({
    basePath: '',
    frameworks: ['jasmine'],
    files: ['spec/*.js'],
    port: 8080,
    browsers: ['Chrome'],
    plugins: [
      'karma-phantomjs-launcher',
      'karma-chrome-launcher',
      'karma-jasmine'
    ]
  });
};
```

???
Browser can be Chrome, Firefox, Opera, Safari, IE, with or without graphical output: `xvfb`. Or PhantomJS.

---
# The test (Jasmine)
File `test/spec/test.js`:
```js
(function () {
  'use strict';
  describe('Give it some context', function () {
    describe('maybe a bit more context here', function () {
      it('should run here few assertions', function () {
        expect(true).toBe(true);
      });
    });
  });
})();
```

???
Dependencies of this test are limited to only Jasmine.

---
# Run tests
```bash
$ cd test/
$ karma start
$ karma start karma.conf.js
```

---
{state: divider}
<div class="heading"><img src="/images/mm18it/mocha.svg" /></div>
# Adding Mocha

---
# Karma + Mocha
Installing packages:
```js
$ npm  install karma-mocha mocha
```

---
# Karma config for Mocha
File `karma.conf.js`:
```js
module.exports = function(config) {
  'use strict';
  config.set({
    basePath: '',
    frameworks: ['mocha'],
    files: ['spec/*.js'],
    port: 8080,
    browsers: ['Chrome'],
    plugins: [
      'karma-phantomjs-launcher',
      'karma-chrome-launcher',
      'karma-mocha'
    ]
  });
};
```

---
# Run tests
Mocha only:
```bash
$ node_modules/mocha/bin/mocha test/spec/test.js
```
or via Karma:
```bash
$ cd test/
$ karma start
$ karma start karma.conf.js
```

---
# The test (Mocha)
File `test/spec/test.js`:
```js
(function () {
  'use strict';
  const assert = require('assert');
  describe('Give it some context', function () {
    describe('maybe a bit more context here', function () {
      it('should run here few assertions', function () {
        assert.equal(true, 1);
      });
    });
  });
})();
```

???
Example is using NodeJS `assert`. Note that `require` is provided by the NodeJS version of RequireJS, not the browser version of RequireJS. Dependencies of this test are Jasmine, Mocha, NodeJS assert (which doesn't exist in browser) and RequireJS.

---
{state: divider}
<div class="heading"><img src="/images/mm18it/chai.png" /></div>
# Adding Chai

---
# Adding Chai
Installing packages:
```bash
$ npm install karma-chai
```

---
# Karma config for Mocha+Chai
File `karma.conf.js`:
```js
module.exports = function(config) {
  'use strict';
  config.set({
    basePath: '',
    frameworks: ['mocha', 'chai'],
    files: ['spec/*.js'],
    port: 8080,
    browsers: ['Chrome'],
    plugins: [
      'karma-phantomjs-launcher',
      'karma-chrome-launcher',
      'karma-mocha'
    ]
  });
};
```

---
# Run tests
Mocha only:
```bash
$ node_modules/mocha/bin/mocha test/spec/test.js
```
or via Karma:
```bash
$ cd test/
$ karma start
$ karma start karma.conf.js
```

---
# The test (Mocha+Chai)
File `test/spec/test.js`:
```js
(function () {
  'use strict';
  const assert = chai.assert;
  describe('Give it some context', function () {
    describe('maybe a bit more context here', function () {
      it('should run here few assertions', function () {
        assert.equal(true, 1);
      });
    });
  });
})();
```

???
Dependencies are same as before, plus Chai. Only upside is that Chai does not claim global object `assert`, but adds its own namespace.

---
{state: divider}
<div class="heading"><img src="/images/mm18it/tape.png" /></div>
# From Karma to Tape

---
# Adding Tape
Installing packages:
```bash
$ npm install -g tape
```

Run tests:
```bash
$ tape test/spec/test.js
```

---
# The test (Tape)
File `test/spec/test.js`:
```js
(function () {
  'use strict';
  const test = require('tape');
  test('Give it some context', function (t) {
    t.equal(typeof true, 'boolean');
    t.end();
  });
})();
```

---
{state: divider divider-center divider-bold}
{background-image: mm18it/einstein-robot.jpg}
# Some thoughts

???
We have seen various test setups, where the test itself needed to be changed slightly.

---
{state: divider divider-center divider-bold}
{background-image: mm18it/riccard-does-not-care.jpg}
# We don't care <br/> which tool you use

---
# Whatever works for you
~ Tests should easy and fast
~ Pick one tool & setup. Stick with it.
~ Keep your tests simple

???
Mocha or Jasmine might be difficult to setup, but once configured running the tests should only involve `npm install && npm test`.

---
{state: divider divider-center}
# Asking the right questions

???
Why do we introduce testing? What do we want to know?

---
# What do you want to touch?
~ Mocking the DOM (with `domjs`?)
~ Mocking jQuery
~ Spying

???
Mocking is actually a code smell

---
# Magento JS component
JS component:
```js
define(['jquery'], function($) {
    myComponentFunction = function(config, element) {
        $(element).append('Hello World');
    }

    return {
        'my-component': myComponentFunction
    }
});
```

PHTML template:
```html
<div class="my-div" data-mage-init="{'my-component':{}}"></div>
```

???
Here, the document has a state without text. Next, the JS component changes this via jQuery. The JS component has a dependency with jQuery.

---
# Preparing test
Installing packages:
```bash
npm install jsdom
npm install jquery
npm install requirejs
```

MAJOR FAIL: `jQuery requires a window with a document`

RECOMMENDATION: Use Jasmine anyway

???
Maybe mention cheerio

---
{state: divider divider-center}
## Mocking jQuery or just using it?
#### <!-- .element: class="fragment" --> Or maybe it is too hard to mock jQuery?

???
Interaction with DOM is hardest (or stupidiest) thing to test with unit testing. Perhaps end-to-end tests are what you want. The more your code evolves around business logic, the more useful it becomes.

---
{state: divider divider-center}
## How to test methods hidden using the revealing module pattern?
#### <!-- .element: class="fragment" --> Don't test them? Treat it as a black box?

???
Reveal those methods anyway? What good is the revealing module pattern then? Black box principle?

---
{state: divider divider-center}
## Depending on RequireJS or faking it?
#### <!-- .element: class="fragment" --> Beware of the NodeJS versioning nightmare

---
# Refactoring
~ Dependency Injection (RequireJS)
~ Limit dependencies per JS component
~ Keep JS component small
~ Separate JS component per purpose
    - General-purpose library
    - Pure functions
    - Model
    - View

---
{state: divider divider-center}
## Each part has its own way of testing


---
{state: divider divider-center}
# Thanks
## @jissereitsma / @yireo
#### http://slides.yireo.com/yireo/js_testing

???
sinon

What to test in JavaScript": Dealing with unit tests and integration tests; which dependencies to mock; test doubles, object replacement and spies, what not to do.

uses Chai as Promised for fluent promise assertions
