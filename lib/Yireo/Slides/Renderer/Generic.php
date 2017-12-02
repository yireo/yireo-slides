<?php
namespace Yireo\Slides\Renderer;

class Generic
{
    /**
     * @param string $content
     * @return string
     */
    protected function replacePatterns($content): string
    {
        $patterns = [
            '/^\-\ ([a-zA-Z0-9\ \-\.]+)\:\ (.*)$/m' => '- <span class="label">\1&nbsp;</span><span class="value">\2</span>',
            '/^\~\ /m' => "--\n\n- ", // Automatic RemarkJS inline steps
            '/^\ \ \~\ /m' => "--\n\n  - ", // Automatic RemarkJS inline steps (with indented points)
        ];

        foreach ($patterns as $pattern => $patternReplacement) {
            $content = preg_replace($pattern, $patternReplacement, $content);
        }

        return $content;
    }

    /**
     * @param string $content
     * @return string
     */
    protected function replaceTags(string $content): string
    {
        $tags = [
            'main' => 'class: center, middle, main',
            'center' => 'class: center, middle'
        ];

        foreach ($tags as $tag => $tagReplacement) {
            $content = str_replace('{'.$tag.'}', $tagReplacement, $content);
        }

        return $content;
    }
}