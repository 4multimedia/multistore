<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Models\MediaDirectory;
	use Multimedia\Multistore\Core\Models\MediaFiles;

	class Media {

		public function directoryList($mediaDirectory = null) {
			$id = $mediaDirectory->id ? $mediaDirectory->id : null;
			return MediaDirectory::where('id_media_directory_parent', $id)->orderBy('name', 'ASC')->get();
		}

		public function directoryTrashed() {
			return MediaDirectory::onlyTrashed()->get();
		}

		public function directoryStore($request, $mediaDirectory = null) {
			$id_media_directory_parent = $mediaDirectory->id ? $mediaDirectory->id : null;

			return MediaDirectory::create([
				'id_media_directory_parent' => $id_media_directory_parent,
				'name' => $request->name,
				'params' => $request->params
			]);
		}

		public function directoryRestore($request, $mediaDirectory) {
			return $mediaDirectory->update(['name' => $request->name]);
		}

		public function directoryDelete($mediaDirectory) {
			return $mediaDirectory->delete();
		}

		public function FilesList($mediaDirectory = null) {
			$id = $mediaDirectory->id ? $mediaDirectory->id : null;
			return MediaFiles::where('id_media_directory', $id)->orderBy('name', 'ASC')->get();
		}

		public function transformList($items, $fields, $additionals) {
			$array = [];
			foreach($items as $key => $item) {
				foreach($fields as $field) {
					$array[$key][$field] = isset($item->{$field}) ?
					$item->{$field} : null;
				}
				$array[$key] = array_merge($array[$key], $additionals);
			}

			return $array;
		}
	}
