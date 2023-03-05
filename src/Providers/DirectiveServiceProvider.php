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

            Blade::directive('render_view', function ($view) {
                $template = find_view($view);
                return "<?php echo \$__env->make('$template', Arr::except(get_defined_vars(), array('__data', '__path'))); ?>";
            });
        }
    }
