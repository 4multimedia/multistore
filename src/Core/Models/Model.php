<?php

	namespace Multimedia\Multistore\Core\Models;

	use Vinkla\Hashids\Facades\Hashids;
	use Illuminate\Database\Eloquent\Model as BaseModel;

	class Model extends BaseModel {

		public $appends = ['hash'];
	}
