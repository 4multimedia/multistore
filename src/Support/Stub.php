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
        protected $namespaceController;
        protected $extended = false;
        protected $filename;
        protected $path;

        public function __construct($path, $type, $inputs = [])
        {
            $dir = app_path();

            if (isset($this->inputs['extended'])) {
                $this->extended = $this->inputs['extended'];
            }

            $this->type = $type;

            $this->inputs = $inputs;
            if (isset($this->inputs['module'])) {
                $this->module = $this->inputs['module'];
            }

            $this->stubLocation = dirname(__FILE__)."/../Commands/stubs/".$path.".stub";
            $this->namespace = "App\\".($this->extended ? "Extended\\" : "")."Modules\\".$this->module."\\".$this->type;
            $this->newLocation = null;
            $this->className = null;

            if (isset($this->inputs['class'])) {
                $this->className = $this->inputs['class'].($this->extended ? "Extended" : "");
                $this->filename = $this->inputs['class'].substr($this->type, 0, strlen($this->type)-1).'.php';
            }
            $this->path = $path;
            $this->namespaceController = "App\\".($this->extended ? "Extended\\" : "")."Modules\\".$this->module."\\Http\\Controllers";
            $this->fileLocation = app_path(($this->extended ? "Extended/" : "").'Modules/'.$this->module.'/'.$this->type.'/'.$this->filename);
        }

        public function getContent() {
            $content = file_get_contents($this->stubLocation);

            $variables = ['namespace', 'class', 'module'];

            $array['{{NAMESPACE}}'] = $this->namespace;
            $array['{{NAMESPACECONTROLLER}}'] = $this->namespaceController;
            $array['{{CLASS}}'] = $this->className;
            $array['{{class}}'] = Str::lower($this->className);
            $array['{{module}}'] = Str::lower($this->module);
            $array['{{Module}}'] = $this->module;

            $array['{{EXTENDEDDIR}}'] = $this->extended ? 'Extended/' : '';
            $array['{{EXTENDEDNAMESPACE}}'] = $this->extended ? 'Extended\\' : '';
            $array['{{EXTENDED}}'] = $this->extended ? '.extended' : '';

            $content = strtr($content, $array);

            return $content;
        }

        public function save() {
            return file_put_contents($this->fileLocation, $this->getContent());
        }

        public function copy($destiny) {
            $destiny = app_path(($this->extended ? "Extended/" : "").'Modules/'.$this->module.'/'.$this->path.'.php');
            return file_put_contents($destiny, $this->getContent());
        }
    }
