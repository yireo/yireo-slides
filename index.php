<?php
$slideGroups = array(
    array(
        'group' => 'Yireo',
        'style' => 'yireo',
        'slides' => array(
            array('file' => 'yireo/custom_plugin', 'title' => 'Joomla System Plugin Per Project (NL)'),
            array('file' => 'yireo/plugins', 'title' => 'Introducie tot Joomla Plugins &amp; Events (NL)'),
            array('file' => 'yireo/ssl', 'title' => 'Joomla &amp; SSL'),
            array('file' => 'yireo/zray_design', 'title' => 'Joomla &amp; Zend Server Z-Ray - Templaters Aid'),
            array('file' => 'yireo/zray_plugins', 'title' => 'Joomla &amp; Zend Server Z-Ray - Plugins and Events'),
            array('file' => 'yireo/leercurves', 'title' => 'Yireo Educatie - Leren samen met Yireo'),
        ),
    ),
    array(
        'group' => 'MUG073 - Magento User Group Den Bosch',
        'style' => 'mug073',
        'slides' => array(
            array('file' => 'mug073/magerun/magerun', 'title' => 'n98-magerun'),
            array('file' => 'mug073/composer/composer', 'title' => 'Composer &amp; Packagist'),
            array('file' => 'mug073/xml/intro', 'title' => 'Magento XML Introduction'),
            array('file' => 'mug073/xml/layout', 'title' => 'Layout XML'),
            array('file' => 'mug073/xml/magento2', 'title' => 'Magento 2 XML'),
        ),
    ),
    array(
        'group' => 'DJPD - Dutch Joomla PHP Developers',
        'style' => 'djpdnl',
        'slides' => array(
            array('file' => 'djpd/automation/phing', 'title' => 'Automation Tools - Phing'),
            array('file' => 'djpd/automation/grunt', 'title' => 'Automation Tools - Grunt'),
            array('file' => 'djpd/automation/gulp', 'title' => 'Automation Tools - Gulp'),
            array('file' => 'djpd/automation/yireo', 'title' => 'Automation Tools - Yireo mojo'),
        ),
    ),
);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Yireo Slides</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="css/yireo.min.css" />
    <link rel="stylesheet" href="css/yireo.custom.css" />
  </head>
  <body>
    <div class="container container-heading">
    <img src="images/yireo-logo.png" align="right" />
    <h1>Yireo Slides <small>built with <a target="_new" href="http://remarkjs.com/#1">remark</a></small></h1>
    </div>
    <div class="container">
    <div class="box-gradient advertizement">
        <div class="content">
            <img src="images/book.png" />
            <h2>THE Book for Joomla Devs</h2>
            <p>
                360+ pages of guided programming<br/>
                complete reference for plugins &amp; events<br/>
                <a href="https://www.yireo.com/jpb">Get your copy now</a>
            </p>
        </div>
    </div>
    <?php foreach($slideGroups as $slideGroup): ?>
    <h3><?php echo $slideGroup['group']; ?></h3>
    <ul>
        <?php foreach($slideGroup['slides'] as $slide) : ?>
        <li>
            <?php $title = $slide['title']; ?>
            <a href="slide.php?style=<?= $slideGroup['style'] ?>&slide=<?= $slide['file'] ?>&title=<?= $title; ?>">
                <?php echo $title; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <hr/>
    <?php endforeach; ?>
    </div>
  </body>
</html>
