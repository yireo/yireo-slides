<?php
namespace Yireo\Slides;

/**
 * Class Definition
 *
 * @package Yireo\Slides
 */
class Definitions
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

    /**
     * @param string $search
     *
     * @return Definition
     */
    public function find(string $search) : Definition
    {
        foreach($this->data as $slideGroup) {
            foreach($slideGroup['slides'] as $slideSet) {
                if ($slideSet['file'] !== $search) {
                    continue;
                }

                $definition = new Definition($slideSet);
                return $definition;
            }
        }

        throw new \InvalidArgumentException('Definition not found');
    }
}