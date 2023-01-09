<?php

    namespace App\Modules\Product\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;

    class WidgetController extends Controller {
        public function chart() {
            echo view('module.product.backend::widget.chart');
        }
    }
