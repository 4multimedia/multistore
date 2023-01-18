<?php

namespace Multimedia\Multistore\Core\Http\Traits;

use Multimedia\Multistore\Core\Http\Classes\Import;

trait useImport {
	public function import() {
		set_title('Import');
		return view('backend::import.form');
	}

	public function runImport() {
		$fields = [];
		$update[0] = 'product.code';
		$fields[1] = 'product.name';
		$fields[2] = 'product.options.unit';
		$fields[3] = 'product.description';
		$fields[5] = 'product.options.kod2';
		$fields[6] = 'product.options.nadwozie_okres';

		$import = new Import($fields, $update, 'pl', true);
		$import->import();

		die;
	}
}
