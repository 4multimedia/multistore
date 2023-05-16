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
use Multimedia\Multistore\Core\Http\Components\Input\Textarea;
use Multimedia\Multistore\Core\Http\Components\Input\Password;
use Multimedia\Multistore\Core\Http\Components\Input\Radio;
use Multimedia\Multistore\Core\Http\Components\Form\FormInput;
use Multimedia\Multistore\Core\Http\Components\Form\FormField;
use Multimedia\Multistore\Core\Http\Components\Form\FormError;

class ComponentServiceProvider extends ServiceProvider {

	public function register() {

	}

	public function boot() {
		$this->loadViewComponentsAs('backend', [
			Editor::class,
            Meta::class,
            Publish::class,
            DictionaryCheckbox::class,
		]);

		$this->loadViewComponentsAs('frontend', [
			Layout::class,
			Dropdown::class,
			Text::class,
			Textarea::class,
			Checkbox::class,
			Radio::class,
            Password::class,
            FormInput::class,
            FormField::class,
            FormError::class
		]);
	}
}

?>
