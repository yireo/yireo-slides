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
            $attributes = $this->renderSection($slide);
            $slides[$slideId] = $sectionStart . $slide . $sectionEnd;
        }

        return implode('',$slides);
    }

    /**
     * @param string $section
     *
     * @return array
     */
    private function renderSection(string &$section) : array
    {
        $attributes = [];

        if (preg_match('/\{background-image: (.*)\}/', $section, $match)) {
            $section = str_replace($match[0], '', $section);
        }

        if (preg_match('/\{background-image: (.*)\}/', $section, $match)) {
            $section = str_replace($match[0], '', $section);
        }

        $section = trim($section);
        return $attributes;
    }
}