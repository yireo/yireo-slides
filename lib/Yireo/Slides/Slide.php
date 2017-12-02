<?php
namespace Yireo\Slides;

class Slide
{
    /**
     * @var string
     */
    private $rootDirectory;

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
    public function __construct(string $rootDirectory, string $filename)
    {
        $this->rootDirectory = $rootDirectory;
        $this->setFilename($filename);
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename)
    {
        $filename = preg_replace('/([^a-zA-Z0-9\/\_\.\-]+)/', '', $filename);

        if (!is_dir($this->rootDirectory)) {
            throw new \InvalidArgumentException('Root directory is incorrect: '.$this->rootDirectory);
        }

        if (empty($filename)) {
            throw new \InvalidArgumentException('Empty filename');
        }

        $filename = realpath($this->rootDirectory.'/'.$filename);
        if(!file_exists($filename)) {
            throw new \InvalidArgumentException('Filename not found: '.$filename);
        }

        if(stristr($filename, $this->rootDirectory) == false) {
            throw new \InvalidArgumentException('Filename seems outside root directory: '.$this->rootDirectory.' / '.$filename);
        }

        $this->filename = $filename;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        $this->getFileContent();
        $this->replaceTags();
        $this->replacePatterns();

        $this->slides = explode("\n---\n", $this->content);
        

        return $this->content;
    }

    /**
     * @return string
     */
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