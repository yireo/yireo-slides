layout: true
<div class="slide-heading">PWA: Is the end?</div>
<div class="slide-footer">
    <span>PWA: Is the end? - Jisse Reitsma - ChristMage 2017 Aachen</span>
</div>

---
{main}
# PWA: Is this the end?

---
{center}
## JavaScript
### our peculiar friend

---
# Lovely typing
Defining some tests:
```js
var test = require('tape');

test('null is an object', function (t) {
  t.equal(typeof null, 'object');
  t.end();
});

test('NaN is a number', function (t) {
  t.equal(typeof NaN, 'number');
  t.end();
});
```

Running the tests:
```bash
$ tape ./test.js
```

---
# Moving scope
```js
var someVar = 'hello';
setTimeout(function() { alert(someVar); }, 1000);
var someVar = 'goodbye';
```

And the output is ...?

---
# Magento 2 frontend
- XML layout
- PHTML templates
- Block classes
- RequireJS dependency management
- KnockoutJS templating
- UiComponents

---
# Magento 2 JavaScript
- `x-magento-init` / `data-mage-init`
- KnockoutJS observers and subscribers
- Private content via `customer-data.js`
- Custom KO `data-bind` handlers
- RequireJS mixins
- UiComponent
- (linking/importing/exporting)
