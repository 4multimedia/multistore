<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Core\Http\Components\Editor;
use Multimedia\Multistore\Core\Http\Components\Layout;
use Multimedia\Multistore\Core\Http\Components\Meta;
use Multimedia\Multistore\Core\Http\Components\Publish;

class ComponentServiceProvider extends ServiceProvider {

	public function register() {

	}

	public function boot() {
		$this->loadViewComponentsAs('backend', [
			Editor::class,
            Meta::class,
            Publish::class
		]);

		$this->loadViewComponentsAs('frontend', [
			Layout::class,
		]);
	}
}

?>
