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

        public function is_valid_domain($domain) {
            return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain) //valid chars check
            && preg_match("/^.{1,253}$/", $domain) //overall length check
            && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain)); //length of each label
        }

        public function add_domain($domain) {
            if ($this->is_valid_domain($domain)) {
                OptionDomain::create(['domain' => $domain]);
            }
        }

		public function set_id_option_domain($id_option_domain) {
			$this->id_option_domain = $id_option_domain;
		}

		public function get_domain($domain) {
			$find = OptionDomain::where('domain', $domain)->first();
			if ($find) {
				return $find;
			}
			return null;
		}
	}
