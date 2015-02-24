<?php
$slideGroups = array(
    array(
        'group' => 'Yireo',
        'style' => 'yireo',
        'slides' => array(
            array('file' => 'yireo/plugins', 'title' => 'Joomla Plugins'),
            array('file' => 'yireo/ssl', 'title' => 'Joomla &amp; SSL'),
        ),
    ),
    array(
        'group' => 'MUG073 - Magento &amp; Composer',
        'style' => 'mug073',
        'slides' => array(
            array('file' => 'mug073/composer/composer', 'title' => 'Composer &amp; Packagist'),
        ),
    ),
    array(
        'group' => 'MUG073 - Magento XML',
        'style' => 'mug073',
        'slides' => array(
            array('file' => 'mug073/xml/intro', 'title' => 'Introduction'),
            array('file' => 'mug073/xml/layout', 'title' => 'Layout XML'),
            array('file' => 'mug073/xml/magento2', 'title' => 'Magento 2 XML'),
        ),
    ),
    array(
        'group' => 'DJPD - Automation Tools',
        'style' => 'djpdnl',
        'slides' => array(
            array('file' => 'djpd/automation/phing', 'title' => 'Phing'),
            array('file' => 'djpd/automation/grunt', 'title' => 'Grunt'),
            array('file' => 'djpd/automation/gulp', 'title' => 'Gulp'),
            array('file' => 'djpd/automation/yireo', 'title' => 'Yireo mojo'),
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
            <?php $title = $slideGroup['group'].' - '.$slide['title']; ?>
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
