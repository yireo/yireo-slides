<?php

namespace Yireo\Slides;

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
    private $file;

    /**
     * @var string
     */
    private $style;

    /**
     * @var string
     */
    private $title;

    /**
     * @var bool
     */
    private $showFooter;

    /**
     * @var bool
     */
    private $showHeader;

    /**
     * Definition constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->file = $data['file'];
        $this->style = (!empty($data['style'])) ? $data['style'] : $data['style'];
        $this->title = $data['title'];

        if (isset($data['header'])) {
            $this->showHeader = (bool) $data['header'];
        }

        if (isset($data['footer'])) {
            $this->showFooter = (bool) $data['footer'];
        }
    }

    public function generateSlide()
    {

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