<?php
namespace Yireo\Slides;

class Slide
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $content = '';

    /**
     * Slide constructor.
     *
     * @param string $filename
     */
    public function __construct(string $filename = '')
    {
        if (!empty($filename)) {
            $this->setFilename($filename);
        }
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename)
    {
        if (empty($filename)) {
            throw new \InvalidArgumentException('Empty filename');
        }

        if(!file_exists($filename)) {
            throw new \InvalidArgumentException('Filename not found: '.$filename);
        }

        $this->filename = $filename;
    }

    /**
     * @param string $rootDirectory
     *
     * @return bool
     */
    public function isAccessibleFromRoot(string $rootDirectory): bool
    {
        if(stristr($this->filename, $rootDirectory) == false) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        $this->getFileContent();
        $this->replaceTags();
        $this->replacePatterns();

        return $this->content;
    }

    private function getFileContent() : string
    {
        $this->content = file_get_contents($this->filename);
        return $this->content;
    }

    /**
     * @return string
     */
    private function replacePatterns(): string
    {
        $patterns = [
            '/^\-\ ([a-zA-Z0-9\ \-\.]+)\:\ (.*)$/m' => '- <span class="label">\1&nbsp;</span><span class="value">\2</span>',
            '/^\~\ /m' => "--\n\n- ", // Automatic RemarkJS inline steps
            '/^\ \ \~\ /m' => "--\n\n  - ", // Automatic RemarkJS inline steps (with indented points)
        ];

        foreach ($patterns as $pattern => $patternReplacement) {
            $this->content = preg_replace($pattern, $patternReplacement, $this->content);
        }

        return $this->content;
    }

    /**
     * @return string
     */
    private function replaceTags(): string
    {
        $tags = [
            'main' => 'class: center, middle, main',
            'center' => 'class: center, middle'
        ];

        foreach ($tags as $tag => $tagReplacement) {
            $this->content = str_replace('{'.$tag.'}', $tagReplacement, $this->content);
        }

        return $this->content;
    }
}