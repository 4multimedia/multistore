<?php

	namespace Multimedia\Multistore\Classes;

	use Multimedia\Multistore\Core\Models\OptionDomain;

    class Domain {
		public $id_option_domain;

		public function get_list() {
			return OptionDomain::get();
		}

		public function count() {
			return OptionDomain::count();
		}

		public function current() {
			$current = OptionDomain::where('id_option_domain', $this->id_option_domain)->first();
			if ($current) {
				return $current;
			}
			return OptionDomain::first();
		}

		public function set_id_option_domain($id_option_domain) {
			$this->id_option_domain = $id_option_domain;
		}
	}
