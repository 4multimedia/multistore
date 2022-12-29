<?php

	namespace Multimedia\Multistore\Core\Http\Classes;

	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Models\MediaDirectory;

	class Media {

		public function directoryList($mediaDirectory = null) {
			$id = $mediaDirectory->id ? $mediaDirectory->id : null;
			return MediaDirectory::where('id_media_directory_parent', $id)->get();
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
	}
