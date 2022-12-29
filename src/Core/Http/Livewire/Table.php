<?php

namespace Multimedia\Multistore\Core\Http\Livewire;

use Livewire\Component;

class Table extends Component
{
	public $message;

    public function mount()
    {
        $this->message = 'Hello World!';
    }

    public function render()
    {
        return view('livewire.table', ['message' => 'aaaaa']);
    }
}

?>
