<?php


$style = preg_replace('/([^a-zA-Z0-9\_\.\-]+)/', '', $style);
$slide = new \Yireo\Slides\Slide(__DIR__, 'slides/'.$slide.'.md');
?>
<!DOCTYPE html>
<html>
  <head>
      <base href="<?php echo $rootUrl; ?><?php echo $request; ?>">
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Alfa+Slab+One|Black+Ops+One|Bowlby+One" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/<?php echo $style; ?>.css" />
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>font-awesome/css/font-awesome.min.css">
  </head>
  <body>
    <textarea id="source"><?php echo $slide->getContent(); ?></textarea>
    <script src="<?php echo $rootUrl; ?>js/remark-latest.min.js"></script>
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
  </body>
</html>
