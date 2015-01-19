<?php
$style = $_GET['style'];
$slide = $_GET['slide'];
$title = $_GET['title'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="css/<?php echo $style; ?>.css" />
  </head>
  <body>
    <textarea id="source"><?php include_once 'slides/'.$slide.'.md'; ?></textarea>
    <script src="https://gnab.github.io/remark/downloads/remark-latest.min.js"></script>
    <script>
      var slideshow = remark.create({
        slideNumberFormat: '<?php echo $title; ?> - %current% of %total%',
        highlightStyle: 'googlecode'
      });
    </script>
  </body>
</html>
