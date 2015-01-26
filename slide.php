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
  </head>
  <body>
    <textarea id="source"><?php include_once $slide; ?></textarea>
    <script src="https://gnab.github.io/remark/downloads/remark-latest.min.js"></script>
    <script>
      var slideshow = remark.create({
        slideNumberFormat: '<?php echo $title; ?> - %current% of %total%',
        highlightStyle: 'googlecode'
      });
    </script>
  </body>
</html>
