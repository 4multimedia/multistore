<?php

namespace Multimedia\Multistore\Core\Http\Traits;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;

trait usePath {
    public function getPathAttribute() {
        $table = $this->getTable();
        $primaryKey = $this->getKeyName();
        if (empty($this->{$primaryKey})) {
            return [];
        }
        $sql = 'SELECT * FROM (SELECT @r AS _id, (SELECT @r := '.$primaryKey.'_parent FROM `'.$table.'` WHERE '.$primaryKey.' = _id) AS '.$primaryKey.'_parent, @l := @l + 1 AS lvl FROM (SELECT @r := '.$this->{$primaryKey}.', @l := 0) vars, `'.$table.'` a WHERE @r <> 0) T1 JOIN `'.$table.'` T2 ON T1._id = T2.'.$primaryKey.'  ORDER BY T1.lvl DESC';
        $items = DB::select($sql);
        $array = [];
        $key = 0;
        foreach($items as $key => $item) {
            $array[$key] = $item;
            $array[$key]->hash = $this->getHash($item->{$primaryKey});
        }

        $key++;
        return $array;
    }
}
