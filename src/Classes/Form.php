<?php

	namespace Multimedia\Multistore\Classes;

    use Illuminate\Support\Facades\Session;

    class Form {

        public $errors;
        public $messages = [];
        public $type = 'vue';

        public function __construct($type = 'vue')
        {
            $this->errors = Session::get('errors');
            if ($this->errors) {
                $this->messages = $this->errors->getMessages();
            }
        }

        public function setType($type) {
            $this->type = $type;
            return $this;
        }

        public function error($name) {
            $error = [];
            if (isset($this->messages[$name])) {
                $error = $this->messages[$name];
            }
            if ($this->type === 'html') {
                return $error;
            }
            return strtr(json_encode($error), ["\"" => "&quot;"]);
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
            if (isset($array["center"]) && ($array["center"] == "true" || $array["center"] == "false")) {
				$array[":center"] = $array["center"];
				unset($array["center"]);
			}
			$array[":error"] = $error;

            if ($this->type === 'vue') {
                return "<$component ".$this->attr($array)."></$component>";
            } else {
                return $this->html_field($component, $array);
            }
        }

        public function html_field($component, $array) {
            $label = $array["label"];
            $errors = $this->error($array["name"]);

            $array["class"] = "form-control";

            unset($array["label"]);
            unset($array[":error"]);
            unset($array["error"]);

            $html = "<div class=\"form-field\"> <label class=\"form-label\">".$label."</label>";
            if ($component === 'textarea') {
                $html .= "<".$component." ".$this->attr($array)."></".$component.">";
            } else {
                $html .= "<".$component." ".$this->attr($array)." />";
            }
            if ($errors) {
                foreach($errors as $error) {
                    $html .= $error;
                }
            }
            $html .= "</div>";
            return $html;
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
						$value = strtr(json_encode($value), ["\"" => "&quot;"]);
					}
					$html[] = "$key=\"$value\"";
				}
			}
			return implode(" ", $html);
		}

        public function text($label, $name, $params = []) {
            $component = 'input-text';
            if ($this->type === 'html') {
                $component = 'x-frontend-text';
            }
			return $this->field($component, $label, $name, $params);
		}

        public function password($label, $name, $params = []) {
			$component = 'input-password';
            if ($this->type === 'html') {
                $component = 'input';
				$params["type"] = "password";
            }
			return $this->field($component, $label, $name, $params);
        }

        public function button($label, $type = 'submit') {
            return "<button type=\"$type\">$label</button>";
        }

        public function dropdown($label, $name, $params = []) {
            return $this->field('dropdown', $label, $name, $params);
        }

		public function checkbox($label, $name, $params = []) {
			return $this->field('input-checkbox', $label, $name, $params);
		}

		public function switch($label, $name, $params = []) {
			return $this->field('input-switch', $label, $name, $params);
		}

        public function gallery($label, $name, $params = []) {
			if (isset($params["value"][$name])) {
				$params["value"] = $params["value"][$name] ? $params["value"][$name] : [];
			}
			return $this->field('input-gallery', $label, $name, $params);
		}

		public function image($label, $name, $params = []) {
			return $this->field('input-image', $label, $name, $params);
		}

		public function treeselect($label, $name, $params = []) {
			return $this->field('input-tree-select', $label, $name, $params);
		}

        public function textarea($label, $name, $params = []) {
            $component = 'input-textarea';
            if ($this->type === 'html') {
                $component = 'textarea';
            }
			return $this->field('input-textarea', $label, $name, $params);
		}
    }
