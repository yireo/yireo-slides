<?php
ini_set('display_errors', 1);

/** @var $slideGroups array */
include_once 'definitions.php';

// Include libraries
require_once 'vendor/autoload.php';
\Yireo\Common\System\Autoloader::init();
\Yireo\Common\System\Autoloader::addPath(__DIR__.'/lib/Yireo');

// Request parsing
$rootUrl = preg_replace('/index\.php(.*)$/', '', $_SERVER['PHP_SELF']);

$request = substr_replace($_SERVER['REQUEST_URI'], '', 0, strlen($rootUrl));
$request = preg_replace('/\?(.*)$/', '', $request);

// Include the slide
if (!empty($request)) {
    $definitions = new \Yireo\Slides\Definitions($slideGroups);

    try {
        $definition = $definitions->find($request);
    } catch(Exception $e) {
        die('Invalid input');
    }

    $slide = $definition->generateSlide(__DIR__);
    include_once 'renderer/'.$definition->getRenderer().'.php';
    exit;
}

$rootUrl = '';
?>
<!DOCTYPE html>
<html>
  <head>
    <base href="/">
    <title>Yireo Slides Repository</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/yireo.min.css" />
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/style.css" />
  </head>
  <body>
    <div class="container container-heading">
    <img src="images/yireo-logo.png" align="right" />
    <h1>Yireo Slides Repository</h1>
    </div>
    <div class="container" style="column-count: 2;">
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
