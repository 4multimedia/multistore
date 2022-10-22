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

        public function field($label) {

        }

        public function text($label, $name) {
            $error = $this->error($name);
            return "<input-text label=\"$label\" type=\"text\" name=\"$name\" value=\"".old($name)."\" :error=\"$error\"></input-text>";
        }

        public function password($label, $name) {
            $error = $this->error($name);
            return "<input-password label=\"$label\" type=\"text\" name=\"$name\" value=\"".old($name)."\" :error=\"$error\"></input-password>";
        }

        public function dropdown($label, $name, $options) {
            return '';
        }
    }
