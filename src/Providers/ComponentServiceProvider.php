<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Core\Http\Components\Editor;
use Multimedia\Multistore\Core\Http\Components\Layout;
use Multimedia\Multistore\Core\Http\Components\Meta;
use Multimedia\Multistore\Core\Http\Components\Publish;
use Multimedia\Multistore\Core\Http\Components\Dictionary\DictionaryCheckbox;
use Multimedia\Multistore\Core\Http\Components\Input\Checkbox;
use Multimedia\Multistore\Core\Http\Components\Input\Dropdown;
use Multimedia\Multistore\Core\Http\Components\Input\Text;
use Multimedia\Multistore\Core\Http\Components\Input\Radio;

class ComponentServiceProvider extends ServiceProvider {

	public function register() {

	}

	public function boot() {
		$this->loadViewComponentsAs('backend', [
			Editor::class,
            Meta::class,
            Publish::class,
            DictionaryCheckbox::class
		]);

		$this->loadViewComponentsAs('frontend', [
			Layout::class,
			Dropdown::class,
			Text::class,
			Checkbox::class,
			Radio::class
		]);
	}
}

?>
