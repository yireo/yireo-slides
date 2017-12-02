<?php
namespace Yireo\Slides\Renderer;

class Remark extends Generic implements RendererInterface
{
    /**
     * @param string $content
     *
     * @return string
     */
    public function render(string $content): string
    {
        $content = $this->replaceTags($content);
        $content= $this->replacePatterns($content);

        return $content;
    }
}