<?php
namespace Yireo\Slides\Renderer;

/**
 * Class Reveal
 *
 * @package Yireo\Slides\Renderer
 */
class Reveal implements RendererInterface
{
    /**
     * @param string $content
     *
     * @return string
     */
    public function render(string $content): string
    {
        $slides = explode("\n---\n", $content);
        $sectionStart = "<section data-markdown>\n<textarea data-template>\n";
        $sectionEnd = "</textarea>\n</section>\n";

        foreach ($slides as $slideId => $slide) {
            $slides[$slideId] = $this->renderSection($slide);
        }

        return $sectionStart.implode($sectionEnd.$sectionStart, $slides).$sectionEnd;
    }

    /**
     * @param string $section
     *
     * @return string
     */
    private function renderSection(string $section) : string
    {
        return $section;
    }
}