<?php

namespace IziDev\KeyValueSuggestion;

use Closure;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Http\Requests\NovaRequest;

class KeyValueSuggestion extends KeyValue
{

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'KeyValueSuggestion';

    private $configSuggestion = [];

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string|callable|null $attribute
     * @param callable|null $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        $this->configSuggestion["configSuggestion"] =
            [
                "list" => null,
                "display" => null,
                "max" => 5,
                "length" => 3
            ];

        parent::__construct($name, $attribute, $resolveCallback);
    }

    public function suggestion($list)
    {
        $this->configSuggestion["configSuggestion"]["list"] = $list;

        return $this;
    }

    public function display($title, $showInput, $description = null)
    {
        $this->configSuggestion["configSuggestion"]["title"] = $title;
        $this->configSuggestion["configSuggestion"]["showInput"] = $showInput;
        $this->configSuggestion["configSuggestion"]["description"] = $description;

        return $this;
    }

    public function max($max)
    {
        $this->configSuggestion["configSuggestion"]["max"] = $max;

        return $this;
    }

    public function length($length)
    {
        $this->configSuggestion["configSuggestion"]["length"] = $length;

        return $this;
    }

    public function meta()
    {
        $this->meta = array_merge($this->meta, $this->configSuggestion);

        return $this->meta;
    }
}
