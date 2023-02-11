<?php

    namespace Multimedia\Multistore\Support;

    use Str;

    class Stub {

        protected $className;
		protected $component;
		protected $place;
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
		protected $primaryKey;

        public function __construct($path, $type, $inputs = [])
        {
            $dir = app_path();
            $this->inputs = $inputs;

            if (isset($this->inputs['extended'])) {
                $this->extended = $this->inputs['extended'];
            }

            $this->type = $type;

            if (isset($this->inputs['module'])) {
                $this->module = $this->inputs['module'];
            }
            if (isset($this->inputs['fileLocation'])) {
                $this->fileLocation = app_path(($this->extended ? "Extended/" : "").'Modules/'.$this->module.'/'.$this->inputs['fileLocation']);
            }
			if (isset($this->inputs['component'])) {
                $this->component = $this->inputs['component'];
            }
            if (isset($this->inputs['place'])) {
                $this->place = $this->inputs['place'];
            }

            $this->stubLocation = dirname(__FILE__)."/../Commands/stubs/".$path.".stub";
            $this->namespace = "App\\".($this->extended ? "Extended\\" : "")."Modules\\".$this->module."\\".$this->type;

            if (isset($this->inputs['namespace'])) {
                $this->namespace = $this->inputs['namespace'];
            }

            $this->newLocation = null;
            $this->className = null;
            $this->table = null;

            if (isset($this->inputs['table'])) {
                $this->table = $this->inputs['table'];
                $this->fileLocation = app_path(($this->extended ? "Extended/" : "").'Modules/'.$this->module.'/Database/Migration');
                $this->filename = date('Y_m_d_His').'_create_'.mb_strtolower($this->table, 'utf-8').'_table.php';
                $this->primaryKey = 'id_'.mb_strtolower($this->table, 'utf-8');
            }

            if (isset($this->inputs['class'])) {
                $this->className = $this->inputs['class'].($this->extended ? "Extended" : "");
                $this->filename = $this->inputs['class'].substr($this->type, 0, strlen($this->type)-1).'.php';
            }
            $this->path = $path;
            $this->namespaceController = "App\\".($this->extended ? "Extended\\" : "")."Modules\\".$this->module."\\Http\\Controllers";
            if (!isset($this->inputs['fileLocation'])) {
                $this->fileLocation = app_path(($this->extended ? "Extended/" : "").'Modules/'.$this->module.'/'.$this->type.'/'.$this->filename);
            }
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
			$array['{{component}}'] = Str::lower($this->component);
            $array['{{Component}}'] = $this->component;
            $array['{{place}}'] = Str::lower($this->place);
            $array['{{Place}}'] = $this->place;

            $array['{{Table}}'] = $this->table;
            $array['{{primaryKey}}'] = $this->primaryKey;

            $array['{{EXTENDEDDIR}}'] = $this->extended ? 'Extended/' : '';
            $array['{{EXTENDEDNAMESPACE}}'] = $this->extended ? 'Extended\\' : '';
            $array['{{EXTENDED}}'] = $this->extended ? '.extended' : '';

            $content = strtr($content, $array);

            return $content;
        }

        public function save() {
            return file_put_contents($this->fileLocation, $this->getContent());
        }

        public function copy($destiny, $path = null) {
            $destiny = app_path(($this->extended ? "Extended/" : "").'Modules/'.$this->module.'/'.(!empty($path) ? $path : $this->path).'.php');
            return file_put_contents($destiny, $this->getContent());
        }
    }
