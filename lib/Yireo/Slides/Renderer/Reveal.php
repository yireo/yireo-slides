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
        foreach ($slides as $slideId => $slide) {
            $slides[$slideId] = $this->renderSection($slide);
        }

        return implode('',$slides);
    }

    /**
     * @param string $section
     *
     * @return string
     */
    private function renderSection(string $section) : string
    {
        $sectionAttributes = [];

        if (preg_match('/\{background-image: (.*)\}/', $section, $match)) {
            $section = str_replace($match[0], '', $section);
            $sectionAttributes[] = 'data-background-image="images/'.$match[1].'"';
        }

        if (preg_match('/\{main\}/', $section, $match)) {
            $section = str_replace($match[0], '', $section);
            $sectionAttributes[] = 
        }

        $sectionStart = "<section data-markdown ".implode(' ', $sectionAttributes).">";
        $sectionStart .= "\n<textarea data-template>\n";
        $sectionEnd = "</textarea>\n</section>\n";

        $section = trim($sectionStart . $section . $sectionEnd;);
        return $section;
    }
}