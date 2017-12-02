<?php
namespace Yireo\Slides\Renderer;

/**
 * Interface RendererInterface
 *
 * @package Yireo\Slides\Renderer
 */
interface RendererInterface
{
    /**
     * @param string $content
     *
     * @return string
     */
    public function render(string $content): string;
}