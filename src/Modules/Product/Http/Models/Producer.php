<?php

    namespace App\Modules\Product\Http\Models;

    use Multimedia\Multistore\Core\Http\Traits\useHash;
    use Multimedia\Multistore\Core\Models\Model;

    class Producer extends Model {

        use useHash;

        public $table = 'producer';
        public $primaryKey = 'id_producer';

    }

?>
