# Nova Field Conditional

<br />

### Demo

![Demo](https://raw.githubusercontent.com/izi-dev/nova-key-value-suggestion-field/master/docs/demo.gif)

<br />

### Installation

The package can be installed through Composer.

```bash
composer require izi-dev/nova-key-value-suggestion-field
```

<br />

### Usage


```php
class Page extends Resource
{

    public function fields(Request $request)
    {
        return [

            \IziDev\KeyValueSuggestion\KeyValueSuggestion::make('Validation')
                ->suggestion([
                    'required',
                    'int',
                    'Alpha Numeric',
                    'Array'
                ])
                ->max(10) //default 5
                ->length(3) //default 3
        ];
    }
}
```

### Advanced

```php
class Page extends Resource
{

    public function fields(Request $request)
    {
        return [

            \IziDev\KeyValueSuggestion\KeyValueSuggestion::make('Validation')
                ->suggestion([
                    [
                        "title" => "Accepted",
                        "id" => "accepted",
                        "description" => "The field under validation must be yes, on, 1, or true. This is useful for validating \"Terms of Service\" acceptance."
                    ],
                    [
                        "title" => "Active URL",
                        "id" => "active_url",
                        "description" => "The field under validation must have a valid A or AAAA record according to the dns_get_record PHP function. The hostname of the provided URL is extracted using the parse_url PHP function before being passed to dns_get_record."
                    ],
                    [
                        "title" => "After (Date)",
                        "id" => "after",
                        "description" => "The field under validation must be a value after a given date."
                    ],
                    [
                        "title" => "After Or Equal (Date)",
                        "id" => "after_or_equal",
                        "description" => "The field under validation must be a value after or equal to the given date. For more information, see the after rule."
                    ],
                    [
                        "title" => "Alpha",
                        "id" => "alpha",
                        "description" => "The field under validation must be entirely alphabetic characters."
                    ],
                    [
                        "title" => "Alpha Dash",
                        "id" => "alpha_dash",
                        "description" => "The field under validation may have alpha-numeric characters, as well as dashes and underscores."
                    ],
                    [
                        "title" => "Alpha Numeric",
                        "id" => "alpha_num",
                        "description" => "The field under validation may have alpha-numeric characters, as well as dashes and underscores."
                    ],
                    [
                        "title" => "Array",
                        "id" => "array",
                        "description" => "The field under validation must be a PHP array."
                    ],
                    [
                        "title" => "Bail",
                        "id" => "bail",
                        "description" => "Stop running validation rules after the first validation failure."
                    ],
                    [
                        "title" => "Required",
                        "id" => "required",
                        "description" => "The field under validation must be present in the input data and not empty."
                    ])
                ->display("title", "id", "description") //string $title,string $showInput, string $description = null
        ];
    }
}
```



### License

The MIT License (MIT). Please see [License File](https://github.com/epartment/nova-dependency-container/blob/master/LICENSE.md) for more information.
