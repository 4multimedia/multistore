<?php

	namespace Multimedia\Multistore\Core\Http\Collection;

    use Illuminate\Database\Eloquent\Collection;

    class TreeCollection extends Collection {

        public function toTree($showChildren = true) {
            if (request('empty')) {
                $showChildren = request('empty') === "false" ? false : true;
            }
            return $this->map(function ($post) use ($showChildren) {
                $node = [
                    'id' => $post->id,
                    'hash' => $post->hash,
                    'text' => $post->name,
                    'opened' => false,
                ];

                if ($showChildren || count($post->subcategories->toTree()) > 0) {
                    $node["children"] = $post->subcategories->toTree();
                }

                return $node;
            });
        }
    }
