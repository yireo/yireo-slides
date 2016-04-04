<?php
include_once 'definitions.php';

$root_url = preg_replace('/index\.php$/', '', $_SERVER['PHP_SELF']);
$request = substr_replace($_SERVER['REQUEST_URI'], '', 0, strlen($root_url));

if (!empty($request)) {
    include_once 'slide.php';
    exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <base href="<?php echo $root_url; ?>">
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
        <?php if (isset($slide['public']) && $slide['public'] == 0) continue; ?>
        <li>
            <?php $title = $slide['title']; ?>
            <a href="<?= $slide['file'] ?>">
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
