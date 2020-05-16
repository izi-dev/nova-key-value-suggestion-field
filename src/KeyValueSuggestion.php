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

    private array $configSuggestion;

    /**
     * Create a new field.
     *
     * @param string $name
     * @param string|callable|null $attribute
     * @param callable|null $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
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

    public function suggestion(array $list): self
    {
        $this->configSuggestion["configSuggestion"]["list"] = $list;

        return $this;
    }

    public function display(string $title,string $showInput, string $description = null): self
    {
        $this->configSuggestion["configSuggestion"]["title"] = $title;
        $this->configSuggestion["configSuggestion"]["showInput"] = $showInput;
        $this->configSuggestion["configSuggestion"]["description"] = $description;

        return $this;
    }

    public function max(int $max): self
    {
        $this->configSuggestion["configSuggestion"]["max"] = $max;

        return $this;
    }

    public function length(int $length): self
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
