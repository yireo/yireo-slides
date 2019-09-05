<?php
namespace Yireo\Slides\Renderer;

/**
 * Class Reveal
 *
 * @package Yireo\Slides\Renderer
 */
class Reveal extends Generic implements RendererInterface
{
    /**
     * @param string $content
     *
     * @return string
     */
    public function render(string $content): string
    {
        $content = preg_replace('/^([\ ]{0,10})\~\ /m', '\1- <!-- .element: class="fragment" -->', $content);

        $content = $this->replaceTags($content);
        $content = $this->replacePatterns($content);

        $slides = explode("\n---\n", $content);
        foreach ($slides as $slideId => $slide) {
            $slide = $this->renderSection($slide);
            $slides[$slideId] = $slide;
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
        $classNames = [];

        if ($sectionParts = explode('???', $section)) {
            $section = $sectionParts[0];
        }

        if (preg_match('/\{background-image: (.*)\}/', $section, $match)) {
            $section = str_replace($match[0], '', $section);
            $sectionAttributes[] = 'data-background-image="images/'.$match[1].'"';
        }

        if (preg_match('/\{state: (.*)\}/', $section, $match)) {
            $section = str_replace($match[0], '', $section);
            $sectionAttributes[] = 'data-state="'.$match[1].'"';
        }

        if (preg_match('/\{class: (.*)\}/', $section, $match)) {
            $section = str_replace($match[0], '', $section);
            $classNames[] = $match[1];
        }

        if (!empty($classNames)) {
            $sectionAttributes[] = 'class="'.implode($classNames).'"';
        }

        $sectionStart = "<section data-markdown ".implode(' ', $sectionAttributes).">";
        $sectionStart .= "\n<textarea data-template>\n";
        $sectionEnd = "</textarea>\n</section>";

        $section = $sectionStart . trim($section) . $sectionEnd."\n";
        return $section;
    }
}