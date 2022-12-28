<?php

	namespace Multimedia\Multistore\Classes;

    class Backend {
		public function get_languages() {
			$array = [];
			$array[] = ["flag" => "pl", "code" => "pl", "label" => "Polski"];
			$array[] = ["flag" => "gb", "code" => "en", "label" => "English"];
			$array[] = ["flag" => "de", "code" => "de", "label" => "Deutsch"];

			return $array;
		}

		public function find_language($lang) {
			foreach($this->get_languages() as $language) {
				if ($language["code"] == $lang) {
					return $language;
				}
			}
		}

		public function get_language() {
			return $this->find_language(app()->getLocale());
		}
	}
