<?php

namespace Multimedia\Multistore\Core\Http\Components\Form;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;

class Input extends Component
{
    public $label = null;
    public $name = null;
    public $error = [];
    public $value = null;
    public $checked = false;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = null, $name = null, $value = null, $checked = false)
    {
        $request = request()->all();

        $this->label = $label;
        $this->name = $name;
        $this->value = $request[$name] ?? (old($name) !== null ? old($name) : (isset($value) ? $value : ''));

        $errors = Session::get('errors');
        if ($errors) {
            $error = $errors->getMessages();
            if (array_key_exists($name, $error)) {
                $this->error = $this->error = $error[$name];
            }
            $this->checked = old($name) !== null ? true : false;
        } else {
            $this->checked = $checked;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

    }
}
