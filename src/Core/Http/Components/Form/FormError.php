<?php

namespace Multimedia\Multistore\Core\Http\Components\Form;

use Illuminate\View\Component;

class FormError extends Component
{
    public $error = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($error = [])
    {
        $this->error = $error;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('frontend::components.form.error');
    }
}
