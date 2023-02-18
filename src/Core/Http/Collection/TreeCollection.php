<?php

	namespace Multimedia\Multistore\Core\Http\Collection;

    use Illuminate\Database\Eloquent\Collection;

    class TreeCollection extends Collection {

        public function toTree($showChildren = true) {
            if (request('empty')) {
                $showChildren = request('empty') === "false" ? false : true;
            }
            return $this->map(function ($model) use ($showChildren) {
                $node = [
                    'id' => $model->id,
                    'hash' => $model->hash,
                    'text' => $model->name,
                    'opened' => false,
                    'isLeaf' => false,
                    'loading' => false
                ];

                if ($showChildren) {
                    if (count($model->subcategories) > 0) {
                        $node["children"] = [
                            ['id' => null, 'text' => 'Wczytywanie...', 'value' => 'Wczytywanie...']
                        ];
                    } else {
                        $node["children"] = [];
                    }
                } else {
                    $node["children"] = null;
                }

                return $node;
            });
        }
    }
