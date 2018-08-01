<?php
/** @var $slide \Yireo\Slides\Slide */
/** @var $definition \Yireo\Slides\Definition */

$style = $definition->getStyle();
$imageDir = dirname(__DIR__).'/images/'.$style;
$imageUrlPrefix = '/images/'.$style.'/';
$images = [];
if (is_dir($imageDir)) {
    $foundImages = glob($imageDir.'/*');
    foreach ($foundImages as $foundImage) {
        if (!preg_match('/\.(jpg|png|svg|gif)$/', $foundImage)) {
            continue;
        }
        $images[] = basename($foundImage);
    }
}

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
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/<?php echo $style ?>.css"/>
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <?php foreach($images as $image) : ?>
        <link rel="preload" href="<?= $imageUrlPrefix . $image ?>" as="image">
    <?php endforeach; ?>
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
    Reveal.configure({transitionSpeed: 'fast', slideNumber: 'c/t', history:true, center: false});
</script>
<script>
	var link = document.createElement( 'link' );
	link.rel = 'stylesheet';
	link.type = 'text/css';
	link.href = window.location.search.match( /print-pdf/gi ) ? 'css/print/pdf.css' : 'css/print/paper.css';
	document.getElementsByTagName( 'head' )[0].appendChild( link );
</script>
</body>
</html>
