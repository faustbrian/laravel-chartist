<?php

/*
 * This file is part of Laravel Chartist.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Chartist;

use Illuminate\View\View;

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
    public function name($name): self
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
    public function element($element): self
    {
        return $this->set('element', $element);
    }

    /**
     * @param array $labels
     *
     * @return Builder
     */
    public function labels(array $labels): self
    {
        return $this->set('labels', $labels);
    }

    /**
     * @param array $series
     *
     * @return Builder
     */
    public function series(array $series): self
    {
        return $this->set('series', $series);
    }

    /**
     * @param $aspectRatio
     *
     * @return Builder
     */
    public function aspectRatio($aspectRatio): self
    {
        return $this->set('aspectRatio', $aspectRatio);
    }

    /**
     * @param $prefix
     *
     * @return Builder
     */
    public function prefix($prefix): self
    {
        return $this->set('prefix', $prefix);
    }

    /**
     * @param $type
     *
     * @return Builder
     */
    public function type($type): self
    {
        if (! array_key_exists($type, $this->types)) {
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
    public function dimension($width, $height = 0): self
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
    public function options(array $options): self
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
    public function responsiveOptions(array $options): self
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
    public function renderCanvas($name): View
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
    public function renderScripts($name): View
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
    private function set($key, $value): self
    {
        array_set($this->charts[$this->name], $key, $value);

        return $this;
    }
}
