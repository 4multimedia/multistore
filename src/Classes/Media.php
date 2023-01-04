<?php

	namespace Multimedia\Multistore\Classes;

	use Multimedia\Multistore\Core\Models\MediaDirectory;

    class Media {
		public function get_image($table, $id_record) {

		}

		public function get_images($table, $id_record, $limit = null) {

		}

		/* DIRECTORIES */

		public function set_directory($id_media_directory_parent, $name) : MediaDirectory {
			$directory = MediaDirectory::where('id_media_directory_parent', $id_media_directory_parent)->where('name', $name)->first();
			if ($directory) {
				return $directory;
			} else {
				return MediaDirectory::create([
					'id_media_directory_parent' => $id_media_directory_parent,
					'name' => $name
				]);
			}
		}

		public function create_directory($path) {
			$dirs = explode("/", $path);

			$array = [];

			$id_media_directory = null;
			$id_media_directory_parent = null;
			foreach($dirs as $key => $dir) {
				$dir = trim($dir);
				$directory = $this->set_directory($id_media_directory_parent, $dir);

				$id_media_directory_parent = $directory->id_media_directory;

				$array[$key] = [
					'id_media_directory_parent' => $directory->id_media_directory_parent,
					'id_media_directory' => $directory->id_media_directory,
					'name' => $directory->name
				];
			}

			return $array;
		}

		public function get_id_directory($path) {

		}

		public function get_path_directory($path) {

		}
	}
