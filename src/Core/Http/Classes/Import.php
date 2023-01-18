<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

	use Illuminate\Support\Facades\DB;
	use Illuminate\Support\Arr;
	use Illuminate\Support\Facades\Schema;

    class Import {
		public $fields = [];
		private $type = '';
		private $types = [];
		private $prepare_fields = [];
		private $file;
		private $data;
		private $hasHeader = true;
		private $lang = '';
		private $update = [];

		public function __construct($fields, $update, $lang, $hasHeader) {
			$this->fields = $fields;
			$this->update = $update;
			$this->hasHeader = $hasHeader;
			$this->lang = $lang;

			$this->openCsv();
		}

		public function import() {
			$records = [];
			foreach($this->fields as $line => $field) {
				$params = explode(".", $field);
				$table = $params[0];
				$column = $params[1];
				unset($params[0]);
				if(isset($this->types[$table][$column])) {
					$type = $this->types[$table][$column];
				} else {
					$type = Schema::getColumnType($table, $params[1]);
					$this->types[$table][$column] = $type;
				}
				$column = implode(".", $params);

				$records[$table][$line] = ["column" => $column, "type" => $type];
			}

			$this->fields($records);
			$this->setData();
		}

		public function fields($records) {
			foreach ($records as $table => $fields) {
				$array = [];
				foreach($fields as $line => $field) {
					$array[$table][$field["column"]] = ["line" => $line, "type" => $field["type"]];
				}
			}
			$this->prepare_fields = $array;
		}

		public function setData() {
			$lines = count($this->data);
			$data = [];
			foreach ($this->prepare_fields as $table => $fields) {
				$array = [];
				for($a = 0; $a < $lines; $a++) {
					foreach ($fields as $field => $info) {
						$value = $this->data[$a][$info["line"]];
						$array[$field] = $value;
					}
					$this->prepare($table, $array);
				}
			}
		}

		public function prepare($table, $array) {
			$array = Arr::undot($array);
			$prepare = [];
			foreach($array as $key => $value) {
				if (is_array($value)) {
					$prepare[$key] = json_encode($value);
				} else {
					if ($this->types[$table][$key] === 'json') {
						$prepare[$key] = json_encode([$this->lang => trim($value)]);
					} else {
						$prepare[$key] = $value;
					}
				}
			}
			DB::table($table)->insert($prepare);
		}

		public function openCsv() {
			$this->file = public_path('towary.csv');
			$file = fopen($this->file, "r");
			$this->data = [];
			$line = 0;
			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
				if ($line == 0 && $this->hasHeader === false) {
					$this->data[] = $line;
				} else {
					$this->data[] = $getData;
				}
				$line++;
			}
		}

		public function openXls() {

		}
	}
