<?php

	namespace Multimedia\Multistore\Classes;

    use Multimedia\Multistore\Core\Models\Page as ModelsPage;

	class Page {
        public function items() {
            return ModelsPage::selectRaw('id_page, name')->get()->toArray();
        }
	}
