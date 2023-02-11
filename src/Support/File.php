<?php

	namespace Multimedia\Multistore\Support;

	class File {

		public $path;
		public $findText;

		public function __construct($path) {
			$this->path = $path;
		}

		public function findText($text) {
			$this->findText = $text;
			return $this;
		}

		public function writeText($text) {
			$replace = $this->findText. "\n\t". $text;
			file_put_contents($this->path, str_replace($this->findText, $replace, file_get_contents($this->path)));
			return $this;
		}
	}

?>
