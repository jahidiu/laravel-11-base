<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    public $id;
    public $name;
    public $label;
    public $options;
    public $value;
    public $required;
    public $column;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param string $name
     * @param string $label
     * @param array $options
     * @param array $value
     * @param bool $required
     * @param int $column
     */
    public function __construct($id, $name, $label = '', $options = [], $value = [], $required = false, $column = 12)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->value = $value;
        $this->required = $required;
        $this->column = $column;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.common.checkbox');
    }
}
