<?php
$slideGroups = array(
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
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="css/<?php echo $style; ?>.css" />
  </head>
  <body>
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
    <?php endforeach; ?>
  </body>
</html>
