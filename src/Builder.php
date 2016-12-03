<?php

/*
 * This file is part of Laravel Chartist.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/*
 * This file is part of Laravel Chartist.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Chartist;

class Builder
{
    /**
     * @var array
     */
    private $charts = [];

    /**
     * @var array
     */
    private $defaults = [
        'aspectRatio'       => null,
        'dimension'         => ['width' => 'auto', 'height' => 'auto'],
        'element'           => null,
        'labels'            => [],
        'options'           => [],
        'prefix'            => 'ct-',
        'responsiveOptions' => [],
        'series'            => [],
        'type'              => 'Line',
    ];

    /**
     * @var array
     */
    private $types = [
        'Bar'  => 'extended',
        'Line' => 'extended',
        'Pie'  => 'minimal',
    ];

    /**
     * @param $name
     *
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;
        $this->charts[$name] = $this->defaults;

        return $this;
    }

    /**
     * @param $element
     *
     * @return Builder
     */
    public function element($element)
    {
        return $this->set('element', $element);
    }

    /**
     * @param array $labels
     *
     * @return Builder
     */
    public function labels(array $labels)
    {
        return $this->set('labels', $labels);
    }

    /**
     * @param array $series
     *
     * @return Builder
     */
    public function series(array $series)
    {
        return $this->set('series', $series);
    }

    /**
     * @param $aspectRatio
     *
     * @return Builder
     */
    public function aspectRatio($aspectRatio)
    {
        return $this->set('aspectRatio', $aspectRatio);
    }

    /**
     * @param $prefix
     *
     * @return Builder
     */
    public function prefix($prefix)
    {
        return $this->set('prefix', $prefix);
    }

    /**
     * @param $type
     *
     * @return Builder
     */
    public function type($type)
    {
        if (!array_key_exists($type, $this->types)) {
            throw new \InvalidArgumentException('Invalid Chart type.');
        }

        return $this->set('type', $type);
    }

    /**
     * @param $width
     * @param int $height
     *
     * @return Builder
     */
    public function dimension($width, $height = 0)
    {
        if (empty($height)) {
            $height = $width;
        }

        return $this->set('dimension', compact('width', 'height'));
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function options(array $options)
    {
        foreach ($options as $key => $value) {
            $this->set('options.'.$key, $value);
        }

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function responsiveOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $this->set('responsiveOptions.'.$key, $value);
        }

        return $this;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function renderCanvas($name)
    {
        $chart = $this->charts[$name];

        return view('chartist::canvas')
                ->with('dimension', $chart['dimension'])
                ->with('element', $chart['element'])
                ->with('prefix', $chart['prefix'])
                ->with('aspectRatio', $chart['aspectRatio']);
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function renderScripts($name)
    {
        $chart = $this->charts[$name];

        return view('chartist::scripts')
                // ->with('context', $chart['context'])
                ->with('series', $chart['series'])
                ->with('element', $chart['element'])
                ->with('labels', $chart['labels'])
                ->with('options', $chart['options'])
                ->with('responsiveOptions', $chart['responsiveOptions'])
                ->with('prefix', $chart['prefix'])
                ->with('type', $chart['type']);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    private function get($key)
    {
        return array_get($this->charts[$this->name], $key);
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    private function set($key, $value)
    {
        array_set($this->charts[$this->name], $key, $value);

        return $this;
    }
}
