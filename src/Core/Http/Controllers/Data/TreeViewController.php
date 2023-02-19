<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Data;

    use App\Http\Controllers\Controller;

    class TreeViewController extends Controller
    {
        public function index() {
            return view('backend::data.treeview');
        }

        public function update() {
            return view('backend::data.treeview');
        }
    }
