<?php

namespace Multimedia\Multistore\Providers;

use Illuminate\Support\ServiceProvider;
use Multimedia\Multistore\Core\Http\Components\Editor;

class ComponentServiceProvider extends ServiceProvider {

	public function register() {

	}

	public function boot() {
		$this->loadViewComponentsAs('backend', [
			Editor::class,
		]);
	}
}

?>
