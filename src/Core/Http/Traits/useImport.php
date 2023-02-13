<?php

namespace Multimedia\Multistore\Core\Http\Traits;

use Illuminate\Http\Request;
use Multimedia\Multistore\Core\Http\Classes\Import;

trait useImport {

	public $import_fields = [];
	public $import_update = [];
	public $import_lang;
	public $import_columns = [];

	public function import() {
		set_title('Import');
		return view('backend::import.form');
	}

	public function prepareImport(Request $request) {
		$path = $request->file('file');
		$separator = $request->separator;
		$file = fopen($path, "r");
		$data = [];
		$data["rows"] = [];
		while (($row = fgetcsv($file, 10000, $separator)) !== FALSE) {
			$data["rows"][] = $row;
		}

		set_title('Import');
		return view('backend::import.prepare', $data);
	}

	public function runImport(Request $request) {
		$fields = [];
		$update = [];

		$this->import_lang = 'pl';
		foreach($request->fields as $key => $col) {
			if ($col) {
				$fields[$key] = $col;
			}
		}

		$update[0] = 'product.code';
		//$fields[1] = 'product.name';
		$fields[2] = 'product.options.unit';
		$fields[3] = 'product.description';
		$fields[5] = 'product.options.kod2';
		$fields[6] = 'product.options.nadwozie_okres';

		$import = new Import($fields, $update, $this->import_lang, true);
		$import->import();

		die;
	}
}
