<?php
/** @var $slide \Yireo\Slides\Slide */
/** @var $definition \Yireo\Slides\Definition */
?>
<!DOCTYPE html>
<html>
<head>
    <base href="<?php echo $rootUrl; ?><?php echo $request; ?>">
    <title><?php echo $definition->getTitle(); ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab|Alfa+Slab+One|Black+Ops+One|Bowlby+One"
          rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/reveal/reveal.css">
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/<?php echo $definition->getStyle(); ?>.css"/>
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>font-awesome/css/font-awesome.min.css">
</head>
<body>
<div class="reveal">
    <div class="slides">
        <?php echo $slide->getContent(); ?>
    </div>
</div>
<script src="<?php echo $rootUrl; ?>js/reveal.js"></script>
<script src="<?php echo $rootUrl; ?>js/reveal/marked.js"></script>
<script src="<?php echo $rootUrl; ?>js/reveal/markdown.js"></script>
<script>
    Reveal.initialize();
    Reveal.configure({slideNumber: 'c/t', history:true});
</script>
</body>
</html>
