<?php
// Fetch parameters
$title = $_GET['title'];
$style = $_GET['style'];
$slide = $_GET['slide'];

// Security checks
$style = preg_replace('/([^a-zA-Z0-9\_\.\-]+)/', '', $style);
$slide = preg_replace('/([^a-zA-Z0-9\/\_\.\-]+)/', '', $slide);
$slide = realpath('slides/'.$slide.'.md');
if(empty($slide)) die('no slide');
if(stristr($slide, __DIR__) == false) die('access denied');
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="css/<?php echo $style; ?>.css" />
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  </head>
  <body>
    <textarea id="source"><?php include_once $slide; ?></textarea>
    <script src="js/remark-latest.min.js"></script>
    <script>
      var slideshow = remark.create({
        slideNumberFormat: '%current% of %total%',
        highlightStyle: 'googlecode'
      });

      /*slideshow.on('afterShowSlide', function (slide) {
        console.log(slide);
      });*/
    </script>
  </body>
</html>
