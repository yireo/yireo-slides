layout: true
<div class="slide-heading">Implementing namespaces in Joomla</div>
<div class="slide-footer">
    <span>www.yireo.com - slides.yireo.com  - #jwc16 - @yireo / @jissereitsma</span>
</div>

---
class: center, middle
# Implementing namespaces
### in Joomla

---
class: center, middle
# http://slides.yireo.com/

---
<img class="img-responsive" src="../slides/yireo/images/gor.jpg" />

---
# Jisse Reitsma
--

- Founder and lead developer of Yireo
--

- Author of "Programming Joomla Plugins"
--

- Trainer & speaker
--

- Part of Zend Z-Team
--

- Magento Master "Mover" 2017
--

- Untrained idiot on a bicycle

---
# This presentation
- Why namespaces are important
- How namespaces are used in Joomla
- How you could use namespaces

---
# Code sample
File `libaries/yireo/Utilities/Calculator.php`:
```php
namespace Yireo\Utilities;

use \Yireo\Api\CalculatorInterface;

class Calculator implements CalculatorInterface
{
    public function multiply($source, $multiplier) { ... }
    public function sum($number1, $number2) { ... }
}
```

---
# Benefits of namespaces
--

- Less collisions in class names
--

- Standardized mapping between classes and files
--

- Using more folders allows for more organization
--

- Option for autoloading
    - PSR-4 standard
    - Composer
--
- Unit testing becomes easier

---
# Joomla & namespaces 
- in Joomla Framework: Everywhere
- in Joomla CMS: Limited

---
# Joomla classes
```php
Joomla\Registry\Registry
Joomla\Utilities\ArrayHelper
Joomla\String\StringHelper

Joomla\Ldap\LdapClient
```

---
# Your own extensions
- Components
- Modules
- Plugins
- Custom libraries

---
# Example plugin
```php
class PlgSystemArticleTags extends JPlugin {
  public function onAfterRender() {
    $body = $this->app->getBody();

    $db = JFactory::getDbo();
    $query = $db->getQuery(true);
    $articleId = $this->params->get('article_id');
    $query->select($db->quoteName('title'));
    $query->from($db->quoteName('#__content'));
    $query->where($db->quoteName('id').'='.$articleId);
    $title = $db->loadResult();

    $body = str_replace('{a.title}', $title, $body);
    $this->app->setBody($body);
  }
}
```

---
# What is wrong?
- One single method containing everything
- No helper methods
- No clear description of functionality

---
class: center, middle
# Refactoring

---
# Single Reponsibility Principle
- Part of SOLID
- Meaning
    - "A class should have only one reason to change"
    - One method should do one thing
    - One class should have one task

---
# Exploding methods (1 of 4)
```php
class PlgSystemArticleTags extends JPlugin
{
  public  function onAfterRender()
  {
    $body = $this->app->getBody();
    $body = $this->replaceTag($body);
    $this->app->setBody($body);
  }
  ...
```

---
# Exploding methods (2 of 4)
```php
class PlgSystemArticleTags extends JPlugin
{
  public  function onAfterRender() {}

  private function replaceTag($string)
  {
    $articleId = $this->getArticleId();
    $title = $this->getArticleTitle($articleId);
    return str_replace('{a.title}', $title, $string);
  }
  ...
```

---
# Exploding methods (2 of 4)
```php
class PlgSystemArticleTags extends JPlugin
{
  public  function onAfterRender() {}
  private function replaceTag($string) {}

  private function getArticleTitle($articleId)
  {
    $db = $this->getDbo();
    $query = $db->getQuery(true);
    $query->select($db->quoteName('title'));
    $query->from($db->quoteName('#__content'));
    $query->where($db->quoteName('id').'='.$articleId);

    return $db->loadResult();
  }
  ...
```

---
# Exploding methods (4 of 4)
```php
class PlgSystemArticleTags extends JPlugin
{
  public  function onAfterRender() {}
  private function replaceTag($string) {}
  private function getArticleTitle($articleId)

  private function getArticleId()
  {
    return $this->params->get('article_id');
  }

  private function getDbo()
  {
    return JFactory::getDbo();
  }
}
```

---
# New signature
```php
class PlgSystemArticleTags extends JPlugin {
  public  function onAfterRender() {}
  private function replaceTag($string) {}
  private function getArticleTitle($articleId) {}
  private function getArticleId() {}
  private function getDbo() {}
}
```

--
- It is a plugin.
- It replaces tags
- It does something with the database

---
# Moving to helpers (1 of 2)
```php
class PlgSystemArticleTags extends JPlugin
{
  public function onAfterRender()
  {
    $body = $this->app->getBody();

    $helper = $this->getHelper();
    $body = $helper->replaceTag($body);

    $this->app->setBody($body);
  }
  ...
```

---
# Moving to helpers (2 of 2)
```php
class PlgSystemArticleTags extends JPlugin
{
  public function onAfterRender() {}

  private function getHelper()
  {
    require_once 'helper.php';
    return new ArticleTagsHelper;
  }
}
```

---
# The helper
```php
class ArticleTagsHelper {
  private function replaceTag($string) {}
  private function getArticleTitle($articleId) {}
  private function getArticleId() {}
  private function getDbo() {}
}
```

---
# And with namespaces
```php
namespace Yireo\Article\Tags;

class Helper {
  private function replaceTag($string) {}
  private function getArticleTitle($articleId) {}
  private function getArticleId() {}
  private function getDbo() {}
}
```

---
# From helpers to actual OOP
- Helpers don't mean a thing
- Bundle classes per functionality
    - Describe your problem
    - Create a class for each subject

---
class: center, middle
# Encapsulation

---
# Moving to real OOP
- Plugin class extending from `JPlugin`
- Class to replace tags in string
    - `Yireo\Utilities\TagHandler`
- Class to encapsulate *simple* articles
    - `Yireo\Database\Article`

---
# Replacing tags
```php
namespace Yireo\Utilities;

class TagHandler
{
    protected $text = '';
    public function _construct() {}
    public function setText($text)
    public function replace($tag, $replacement) {}
}
```
--
```php
$tagHandler = new Yireo\Utilities\TagHandler;
$tagHandler->setText($body);
$body = $tagHandler->replace('article.title', $article);
```

---
# Loading articles
```php
namespace Yireo\Database;

class Article
{
  public function __construct($db) {}
  public function load($id) {}
  public function getTitle() {}
}
```

--
```php
$db = JFactory::getDbo();
$article = new Yireo\Database\Article($db);
$article->load($articleId);
$title = $article->getTitle();
```

---
# Mocking JDatabase (1 of 2)
```php
namespace Yireo\Api;

interface DboInterface extends \JDatabaseInterface
{
    public function getQuery($isNew);
}
```

---
# Mocking JDatabase (2 of 2)
```php
namespace Yireo\Database;

use Yireo\Api\DboInterface;

class Article
{
    public function __construct(DboInterface $db)
    {
        $this->db = $db;
    }

    public function load($articleId)
    {
        $query = $this->db->getQuery(true);
    }
}
```

---
# YireoLib 
- https://github.com/yireo/lib_yireo
- Autoloading:
    - Add `jimport('yireo.loader')` to your code
    - Loads `libraries/yireo/loader.php` to initialize autoloading
    - Calls upon `Yireo\System\Autoloader` which uses PSR-4
- Only used in my personal Joomla extensions

---
# Moving to real OOP
- `Yireo\Common\Exception\PageNotFound`
- `Yireo\Common\Base\Router`
- `Yireo\Event\Speaker\Keynote`
- `Yireo\AddressBook\Connector\Invoicera`

Usable in Joomla, Magento, Laravel, custom PHP apps

---
# Create your own library
--

- Use TDD, BDD, DDD, scrapbooks, diagrams, whatever
--

- Native PHP code without Joomla
--

- Move as much functionality to library as possible
--

- Mimic behaviour of Joomla classes
    - Using bridges, proxies and interfaces
    - Downsize dependency with CMS classes

---
# More thoughts
- Add MVC parents that use namespaces
--

- Create namespaced module helpers
--

- Reuse libraries via composer

---
class: center, middle
### Make your code more agile by using namespaces

---
class: center, middle
### tweet me via @yireo
