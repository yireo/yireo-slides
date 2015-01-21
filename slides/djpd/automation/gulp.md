class: center, middle
# Gulp
## - Automation Tools -
### Dutch Joomla PHP Developers

---
# Gulp
- JavaScript Task Runner
- Installable through Node.js / NPM
- Allows you to define task when gulp is run

---
# Gulp basics
* Install Gulp globally
* Install Gulp packages
* Define gulpfile.js
* gulp

---
# Install Gulp
Install globally:
```shell
$ npm install -g gulp
```

---
# Install Gulp
Install locally:
```shell
$ npm install gulp --save-dev
$ npm install gulp-less --save-dev
```

---
# gulpfile.js
```js
var gulp = require('gulp');

gulp.task('default', function() {
  // some code
});
```

---
# Compile LESS
```js
var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');

gulp.task('less', function () {
  gulp.src('./templates/dummy/less/template.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('./templates/dummy/css'));
});
```

---
# Link
https://github.com/phproberto/joomla-gulp
