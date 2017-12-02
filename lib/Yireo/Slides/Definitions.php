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
     * @var array
     */
    private $data = [];

    /**
     * Definition constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}