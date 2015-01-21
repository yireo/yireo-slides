class: center, middle
# Phing
## - Automation Tools -
### Dutch Joomla PHP Developers

---
# What the phing?
- Phing Is Not Gnu make

--
- XML based building tool

--
- PEAR extension

--
- Targets & tasks

---
# Hello World (1/2)
```xml
<!-- File: build.xml -->
<project name="My extension" default="build" basedir=".">
    <target name="build">
        <echo msg="Hello World" />
    </target>
</project>
```

Call from shell:

    you@server $ phing

---
# Hello World (2/2)
```xml
<!-- File: build.xml -->
<project name="My extension" default="build" basedir=".">
    <target name="helloworld">
        <echo msg="Hello World" />
    </target>
</project>
```

Call from shell:

    you@server $ phing helloworld

---
# Defining variables
```xml
<!-- File: build.xml -->
<exec command="cd ../;pwd" outputProperty="root" />
<exec command="echo /tmp/build.$$" outputProperty="tmp" />
<exec command="date +%Y-%m-%d" outputProperty="date" />

<property name="source" value="${root}/source" />

<exec command="mkdir ${tmp}" />
<property name="gpl" value="${root}/files/gpl-3.0.txt" />
```

---
# Properties file
```xml
<!-- File: build.xml -->
<property file="./build.properties" />
```

```ini
# File: build.properties
version = 1.2.3
source.folder = /var/www/html/joomla
```

---
# Copying files
Single file
```xml
<copy file="${gpl}" tofile="${tmp}" />
```

Multiple files
```xml
<copy todir="${tmp}" haltonerror="false" overwrite="true">
    <fileset dir="${plugins/system/example}">
        <include name="**/**" />
        <include name="*.php" />
        <include name="*.xml" />
        <include name="*.html" />
    </fileset>
</copy>
```

---
# Packaging files
Zip
```xml
<zip destfile="${root}/plg_system_example.tgz">
    <fileset dir="${tmp}">
        <include name="**/**" />
    </fileset>
</zip>
```

Tar
```xml
<tar destfile="${root}/plg_system_example.tgz">
    <fileset dir="${tmp}">
        <include name="**/**" />
    </fileset>
</tar>
```

---
# If-else
```xml
<if><available file="${myfolder}" type="dir" />
    <then>
    </then>
</if>

<if><available file="${myfile}" type="file" />
    <then>
    </then>
</if>

<if><istrue value="${some_flag}" />
    <then>
    </then>
</if>
``` 

---
# Useful stuff (1/2)
Importing files:
```xml
<property name="foobar" value="0" />
<import file="${root}/includes/joomla_plugin.xml"/>
```

Call upon other target:
```xml
<property name="foobar" value="1" override="true" />
<phingcall target="other_target" />
```

---
# Useful stuff (2/2)
Working with git (or whatever command)
```xml
<exec command="cd ${source}; git push origin master;" />
```

PHP checks:
```xml
<php expression="preg_match('/\.min\.js$/', '${js_file}')" 
    returnProperty="js_is_minified"/>
```

---
# Possibilities
* Copy files locally
* Create archive (ZIP, tgz)
* Execute commands (custom scripts, git, phpcs)
* Copy files remotely (scp, rsync, remote git)
* CLI tools to parse variables (grep, sed, awk, tee)

---
# Custom tasks (1/2)
```xml
<adhoc-task name="do_something_awesome">
<![CDATA[
include_once 'phing/tasks/system/PhingTask.php';

class DoSomethingAwesomeTask extends Task {
    public function main() {
    }
}
]]>
</adhoc-task>
```

```xml
<phingcall target="other_task" />
```

---
# Custom tasks (2/2)
```php
public function main() {
    $this->log('Calling some other task');
    $this->project->setProperty('foo', 'bar');
    $callee = $this->callee;
    $callee->setTarget('other_task');
    $callee->setInheritAll(true);
    $callee->setInheritRefs(true);
    $callee->main();
}
```

---
# Tips for using Phing

--
* Take your time to learn it  

--
* Automate as many steps as you can

---
# About this slideshow

--
* gnab/remark slides written in Markdown

--
* Github Flavored Markdown (GFM)

--
* Press p

???
Some notes of my own
