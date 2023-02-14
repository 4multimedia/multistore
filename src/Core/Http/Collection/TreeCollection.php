<?php

	namespace Multimedia\Multistore\Core\Http\Collection;

    use Illuminate\Database\Eloquent\Collection;

    class TreeCollection extends Collection {

        public function toTree() {
            return $this->map(function ($post) {
                return [
                    'id' => $post->id,
                    'hash' => $post->hash,
                    'text' => $post->name,
                    'opened' => false,
                    'children' => $post->subcategories->toTree()
                ];
            });
        }
    }
