<?php
ini_set('display_errors', 1);

$title = null;
$style = null;
$slide = null;
$footer = true;
$header = true;
$root_url = null;

// Fetch parameters
if(empty($request)) {
    $title = $_GET['title'];
    $style = $_GET['style'];
    $slide = $_GET['slide'];
} else {
    foreach($slideGroups as $slideGroup) {
        foreach($slideGroup['slides'] as $slideSet) {
            if($slideSet['file'] == $request) {
                $slide = $slideSet['file'];
                $style = (!empty($slideSet['style'])) ? $slideSet['style'] : $slideGroup['style'];
                $title = $slideSet['title'];
                if (isset($slideSet['header'])) $header = (bool) $slideSet['header'];
                if (isset($slideSet['footer'])) $footer = (bool) $slideSet['footer'];
                break;
            }
        }
    }
}

// Security checks
$style = preg_replace('/([^a-zA-Z0-9\_\.\-]+)/', '', $style);
$slide = preg_replace('/([^a-zA-Z0-9\/\_\.\-]+)/', '', $slide);
$slide = realpath('slides/'.$slide.'.md');

if(empty($slide)) die('no slide');
if(file_exists($slide) == false) die('no slide');

if(stristr($slide, __DIR__) == false) die('access denied');

$root_url = preg_replace('/index\.php$/', '', $_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>
  <head>
    <base href="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="<?php echo $root_url; ?>css/<?php echo $style; ?>.css" />
    <link rel="stylesheet" href="<?php echo $root_url; ?>font-awesome/css/font-awesome.min.css">
  </head>
  <body>
    <textarea id="source"><?php include_once $slide; ?></textarea>
    <script src="<?php echo $root_url; ?>js/remark-latest.min.js"></script>
    <script>
      var slideshow = remark.create({
        slideNumberFormat: '%current% of %total%',
        countIncrementalSlides: false,
        highlightStyle: 'googlecode'
      });

      /*slideshow.on('afterShowSlide', function (slide) {
        console.log(slide);
      });*/
    </script>
    <?php if($footer == false) : ?>
    <style>
    .remark-slide-number { display:none; }
    </style>
    <?php endif; ?>
    <div class="slide-camera" draggable="true"><video id="camera" autoplay="true"></video></div>
    <script src="<?php echo $root_url; ?>js/video.js"></script>
  </body>
</html>
