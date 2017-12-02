<?php
namespace Yireo\Slides\Renderer;

class Remark implements RendererInterface
{
    public function render(string $content): string
    {
        return $content;
    }
}