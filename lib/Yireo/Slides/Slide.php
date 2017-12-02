<?php
namespace Yireo\Slides;

class Slide
{
    /**
     * @var string
     */
    private $filename;

    /**
     * Slide constructor.
     *
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->setFilename($filename);
    }

    /**
     * @param string $filename
     */
    private function setFilename(string $filename)
    {
        if (empty($filename)) {
            throw new \InvalidArgumentException('Empty filename');
        }

        if(!file_exists($filename)) {
            throw new \InvalidArgumentException('Filename not found: '.$filename);
        }

        
        if(stristr($slide, __DIR__) == false)

        $this->filename = $filename;
    }

    public function isAccessible($rootDirectory)
    {

    }

    public function output()
    {
        ob_start();
        require_once $this->filename;
        $slideContent = ob_get_clean();
        $slideContent = str_replace('{main}', 'class: center, middle, main', $slideContent);
        $slideContent = str_replace('{center}', 'class: center, middle', $slideContent);
        $slideContent = preg_replace('/^\-\ ([a-zA-Z0-9\ \-\.]+)\:\ (.*)$/m', '- <span class="label">\1&nbsp;</span><span class="value">\2</span>', $slideContent);
        $slideContent = preg_replace('/^\~\ /m', "--\n\n- ", $slideContent);
        $slideContent = preg_replace('/^\ \ \~\ /m', "--\n\n  - ", $slideContent);
        return $slideContent;
    }
}