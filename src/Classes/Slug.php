<?php

    namespace Multimedia\Multistore\Classes;

    class Slug {
        private $models = [];

        public function register_model($model) {
            $this->models[] = $model;
        }

        public function get_models() {
            return $this->models;
        }
    }

?>
