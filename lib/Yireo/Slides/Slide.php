<?php
namespace Yireo\Slides;

use Yireo\Slides\Renderer\RendererInterface;

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
     * @var RendererInterface
     */
    private $renderer;

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
     * @param RendererInterface $renderer
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
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

        if ($this->renderer instanceof RendererInterface) {
            $this->content = $this->renderer->render($this->content);
        }

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
}