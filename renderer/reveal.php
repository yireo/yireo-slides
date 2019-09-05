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

$content = $slide->getContent();
$baseHref = $rootUrl . $request;
$baseHref = '/';
$rootUrl = '';
?>
<!DOCTYPE html>
<html class="<?= $style ?>">
<head>
    <base href="<?php echo $baseHref; ?>">
    <title><?php echo $definition->getTitle(); ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/style.css"/>
    <?php if (isset($_GET['print-pdf'])) : ?>
        <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/print.css"/>
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $rootUrl; ?>css/highlight-js.min.css">
    <script src="<?php echo $rootUrl; ?>js/highlight.min.js"></script>
    <?php foreach($images as $image) : ?>
        <link rel="preload" href="<?= $imageUrlPrefix . $image ?>" as="image">
    <?php endforeach; ?>
</head>
<body>
<div class="reveal">
    <div class="slides">
        <?php echo $content; ?>
    </div>
</div>
<script src="<?php echo $rootUrl; ?>js/reveal.js"></script>
<script src="<?php echo $rootUrl; ?>js/reveal/marked.js"></script>
<script src="<?php echo $rootUrl; ?>js/reveal/markdown.js"></script>
<script>
    Reveal.initialize();
    Reveal.configure({transitionSpeed: 'fast', slideNumber: 'c/t', history:true, center: false});
</script>
</body>
</html>
