<?php

    namespace Multimedia\Multistore\Support;

    use Str;

    class Stub {

        protected $className;
        protected $fileLocation;
        protected $inputs;
        protected $module;
        protected $stubLocation;
        protected $type;
        protected $namespace;

        public function __construct($type, $inputs = [])
        {
            $dir = app_path();
            $this->type = $type;
            $this->inputs = $inputs;
            $this->module = $this->inputs['module'];
            $this->className = $this->inputs['class'];
            $this->filename = $this->inputs['class'].$this->type.'.php';
            $this->stubLocation = dirname(__FILE__)."/../Commands/stubs/".Str::lower($this->type).".stub";
            $this->namespace = "App\\Modules\\".$this->module."\\".$this->type."s";

            $this->fileLocation = app_path('Modules/'.$this->module.'/'.$this->type.'s/'.$this->filename);
        }

        public function getContent() {
            $content = file_get_contents($this->stubLocation);

            $variables = ['namespace', 'class', 'module'];

            $array['{{NAMESPACE}}'] = $this->namespace;
            $array['{{CLASS}}'] = $this->className;
            $array['{{class}}'] = Str::lower($this->className);
            $array['{{module}}'] = Str::lower($this->module);
            $array['{{Module}}'] = $this->module;

            $content = strtr($content, $array);

            return $content;
        }

        public function save() {
            return file_put_contents($this->fileLocation, $this->getContent());
        }
    }
