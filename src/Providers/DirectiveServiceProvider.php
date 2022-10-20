<?php

    namespace Multimedia\Multistore\Providers;

    use Illuminate\Support\ServiceProvider;
    use Blade;

    class DirectiveServiceProvider extends ServiceProvider {

        public function boot() {
            Blade::directive('input', function ($params) {
                $label = "Label";
                $type = "text";

                if ($type === "text") {
                    return "<label></label> <input type=\"\" />";
                }

                $html = "<label>".$label."</label>";
                $html .= "<input type=\"text\" />";
                return $html;
            });
        }
    }
