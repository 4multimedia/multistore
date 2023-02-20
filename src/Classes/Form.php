<?php

	namespace Multimedia\Multistore\Classes;

    use Illuminate\Support\Facades\Session;

    class Form {

        public $errors;
        public $messages = [];

        public function __construct()
        {
            $this->errors = Session::get('errors');
            if ($this->errors) {
                $this->messages = $this->errors->getMessages();
            }
        }

        public function error($name) {
            $error = [];
            if (isset($this->messages[$name])) {
                $error = $this->messages[$name];
            }
            return strtr(json_encode($error), ["\"" => "'"]);
        }

        public function field($component, $label, $name, $params = []) {
			$error = $this->error($name);

			$array = [];
			$array["label"] = $label;
			$array["name"] = $name;
			foreach($params as $param_key => $param_value) {
				$array[$param_key] = $param_value;
			}
			$array["value"] = old($name) !== null ? old($name) : (isset($params["value"]) ? $params["value"] : '');
			if ($array["value"] == "true" || $array["value"] == "false") {
				$array[":value"] = $array["value"];
				unset($array["value"]);
			}
			$array[":error"] = $error;

            return "<$component ".$this->attr($array)."></$component>";
        }

		public function attr($array) {
			$html = [];
			foreach($array as $key => $value) {
				if (is_bool($value)) {
					if ($value === true) {
						$html[] = "$key=\"true\"";
					} else {
						$html[] = "$key=\"false\"";
					}
				} else {
					if (is_array($value)) {
						$value = strtr(json_encode($value), ["\"" => "'"]);
					}
					$html[] = "$key=\"$value\"";
				}
			}
			return implode(" ", $html);
		}

        public function text($label, $name, $params = []) {
            $error = $this->error($name);

			$array = [];
			$array["label"] = $label;
			$array["name"] = $name;
			foreach($params as $param_key => $param_value) {
				$array[$param_key] = $param_value;
			}
			$array["value"] = old($name) !== null ? old($name) : (isset($params["value"]) ? $params["value"] : '');
			$array[":error"] = $error;

            return "<input-text ".$this->attr($array)."></input-text>";
        }

        public function password($label, $name, $params = []) {
            $error = $this->error($name);

			$array = [];
			$array["label"] = $label;
			$array["name"] = $name;
			foreach($params as $param_key => $param_value) {
				$array[$param_key] = $param_value;
			}
			$array["value"] = old($name);
			$array[":error"] = $error;

            return "<input-password ".$this->attr($array)."></input-password>";
        }

        public function button($label, $type = 'submit') {
            return "<button type=\"$type\">$label</button>";
        }

        public function dropdown($label, $name, $params = []) {
            $error = $this->error($name);

			$array = [];
			$array["label"] = $label;
			$array["name"] = $name;
			foreach($params as $param_key => $param_value) {
				$array[$param_key] = $param_value;
			}
			$array["value"] = old($name);
			$array[":error"] = $error;

            return "<dropdown ".$this->attr($array)."></dropdown>";
        }

		public function checkbox($label, $name, $params = []) {
			return $this->field('input-checkbox', $label, $name, $params);
		}

		public function switch($label, $name, $params = []) {
			return $this->field('input-switch', $label, $name, $params);
		}

        public function gallery($label, $name, $params = []) {
			return $this->field('input-gallery', $label, $name, $params);
		}

		public function image($label, $name, $params = []) {
			return $this->field('input-image', $label, $name, $params);
		}

		public function treeselect($label, $name, $params = []) {
			return $this->field('input-tree-select', $label, $name, $params);
		}

        public function textarea($label, $name, $params = []) {
			return $this->field('input-textarea', $label, $name, $params);
		}
    }
