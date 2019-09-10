<?php

namespace Yireo\Slides;

use Yireo\Slides\Renderer\Remark;
use Yireo\Slides\Renderer\Reveal;

/**
 * Class Definition
 *
 * @package Yireo\Slides
 */
class Definition
{
    /**
     * @var string
     */
    private $file = '';

    /**
     * @var string
     */
    private $style = '';

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $footer = '';

    /**
     * @var mixed|string
     */
    private $renderer = '';

    /**
     * @var bool
     */
    private $showFooter = true;

    /**
     * @var bool
     */
    private $showHeader = true;

    /**
     * Definition constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file = $data['file'];
        $this->title = $data['title'];
        $this->footer = (!empty($data['footer'])) ? $data['footer'] : '';
        $this->style = (!empty($data['style'])) ? $data['style'] : 'yireo';
        $this->renderer = (!empty($data['renderer'])) ? $data['renderer'] : 'remark';

        if (isset($data['header'])) {
            $this->showHeader = (bool) $data['header'];
        }

        if (isset($data['footer'])) {
            $this->showFooter = (bool) $data['footer'];
        }
    }

    /**
     * @param $rootDirectory
     *
     * @return Slide
     */
    public function generateSlide($rootDirectory) : Slide
    {
        $slidePath = 'slides/'.$this->getFile().'.md';
        $slide = new Slide($rootDirectory, $slidePath);

        if ($this->getRenderer() == 'remark') {
            $slide->setRenderer(new Remark());
        }

        if ($this->getRenderer() == 'reveal') {
            $slide->setRenderer(new Reveal());
        }

        return $slide;

    }

    /**
     * @return string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * @return string
     */
    public function getRenderer(): string
    {
        return $this->renderer;
    }

    /**
     * @return bool
     */
    public function isShowFooter(): bool
    {
        return $this->showFooter;
    }

    /**
     * @return bool
     */
    public function isShowHeader(): bool
    {
        return $this->showHeader;
    }
}