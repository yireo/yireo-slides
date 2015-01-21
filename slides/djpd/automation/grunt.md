class: center, middle
# Grunt
## - Automation Tools -
### Dutch Joomla PHP Developers

---
# Grunt
- JavaScript Task Runner
- Installable through Node.js / NPM
- Allows you to define task when grunt is run

---
# Grunt basics
* Install Grunt CLI
* Define package.json
* Install Grunt packages
* Define gruntfile.js
* Run Grunt

---
# Install Grunt 
Install globally:
```shell
$ npm install -g grunt-cli
```

---
# package.json
```json
{
  "name": "YireoGrunt",
  "version": "0.1.0",
  "author": "Jisse Reitsma",
  "private": true,
  "devDependencies": {
    "grunt": "~0.4.0",
    "grunt-contrib-watch": "*",
    "grunt-contrib-less": "~0.12.0",
    "grunt-contrib-cssmin": "~0.11.0",
    "grunt-reload": "~0.2.0"
  }
}
```

---
# Install Grunt 
Install globally:
```shell
$ npm install grunt --save-dev
$ npm install grunt-contrib-watch --save-dev
$ npm install grunt-contrib-less --save-dev
$ npm install grunt-contrib-cssmin --save-dev
$ npm install grunt-reload --save-dev
```

---
# gruntfile.js
```js
module.exports = function(grunt){

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-reload');

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sometask: {}
  });

  grunt.registerTask('default', ['less']);
};
```

---
# or load tasks automatically
```shell
$ npm install load-grunt-tasks --save-dev
```

```js
module.exports = function(grunt){

  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sometask: {}
  });

  grunt.registerTask('default', ['less']);
};
```

---
# Run Grunt
Command to run default task
```shell
$ grunt
```

---
# LESS task
Include in grunt.initConfig({})
```js
less: {
  development: {
    files: {
      'templates/dummy/css/template.css': 
        'templates/dummy/less/template.less'
    }
  }
}
```

Command
```shell
$ grunt less
```

---
# CSS minify
Include in grunt.initConfig({})
```js
cssmin: {
  target: {
    files: [{
      src: 'templates/dummy/css/template.css',
      dest: 'templates/dummy/css/template.min.css'
    }]
  }
}
```

Command
```shell
$ grunt cssmin
```

---
# Watch task
Include in grunt.initConfig({})
```js
watch: {
  styles: {
    files: ['templates/dummy/less/*.less'],
    tasks: ['less', 'cssmin', 'reload'],
    options: {
      nospawn: true
    }
  }
},
```

Command and keep command terminal open
```shell
$ grunt watch
```

---
# Reload task
Include in grunt.initConfig({})
```js
reload: {
  port: 35729,
  liveReload: {}
},
```

---
# Tips
* Do not forget `--save-dev` flag for `npm`
* Bundle tasks together
* Checkout CSS and JS linting

```js
grunt.registerTask('default', ['less', 'cssmin']);
```
