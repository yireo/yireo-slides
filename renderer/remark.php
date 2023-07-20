<?php
/** @var $slide \Yireo\Slides\Slide */
/** @var $definition \Yireo\Slides\Definition */

if (empty($style)) $style = 'yireo';
?>
<!DOCTYPE html>
<html class="<?= $style ?>">
<head>
    <base href="<?php echo $rootUrl; ?><?php echo $request; ?>">
    <title><?php echo $definition->getTitle(); ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Alfa+Slab+One|Black+Ops+One|Bowlby+One"
          rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/<?php echo $definition->getStyle(); ?>.css"/>
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>font-awesome/css/font-awesome.min.css">
</head>
<body>
<textarea id="source"><?php echo $slide->getContent(); ?></textarea>
<script src="<?php echo $rootUrl; ?>js/remark.js"></script>
<script>
    var slideshow = remark.create({
        slideNumberFormat: '%current% of %total%',
        countIncrementalSlides: false,
        highlightStyle: 'googlecode'
    });
</script>
<?php if (!$definition->isShowFooter()) : ?>
    <style>.remark-slide-number {
            display: none;
        }</style>
<?php endif; ?>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
