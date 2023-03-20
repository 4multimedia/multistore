<?php

	namespace Multimedia\Multistore\Classes;

	use Illuminate\Support\Facades\Storage;
	use Multimedia\Multistore\Core\Models\MediaDirectory;
	use Multimedia\Multistore\Core\Models\MediaFiles;
	use Multimedia\Multistore\Core\Models\MediaRelative;
	use Image;

    class Media {

		public $sizes;

		public function __construct()
		{
			$this->sizes = [];
			$sizes = get_option('setting.sizes', ['thumb' => ['width' => 150, 'height' => 150]]);
			$array = [];
			foreach($sizes as $size) {
				$array[$size["id"]] = ["width" => $size["width"], "height" => $size["height"]];
			}
			$this->sizes = $array;
		}

		/* FILES */

		public function upload_image() {

		}

		public function get_image($table, $id_record) {

		}

		public function get_image_path() {

		}

		public function get_images($table, $id_record, $limit = null) {
			if ($limit === 1) {
				return MediaRelative::where('table', $table)->where('id_record', $id_record)->first();
			} else {
				return MediaRelative::where('table', $table)->where('id_record', $id_record)->get();
			}
		}

		public function get_resize_name($path, $key) {

			$sized = $this->sizes[$key];
			$width = $sized['width'];
			$height = $sized['height'];

			$path_array = explode(".", $path);
			$file_extension = $path_array[count($path_array)-1];
			unset($path_array[count($path_array)-1]);
			$new_path = implode(".", $path_array).'_'.$width.'x'.$height.'.'.$file_extension;
			return $new_path;
		}

		public function image_resize($path, $width, $height) {
			$new_path = $this->get_resize_name($path, 'thumb');

			$image = Image::make($path);
			$image->resize($width, $height, function ($constraint) { $constraint->aspectRatio(); });
			return $image->save($new_path);
		}

		public function set_image($file_full_path, $id_media_directory, $org_file_name) {

			$file_full_path_array = explode("/", $file_full_path);
			$file_name = $file_full_path_array[count($file_full_path_array)-1];
			$file_name_array = explode(".", $file_name);
			$file_extension = $file_name_array[count($file_name_array)-1];
			$storage_path = storage_path('app/public/'.$file_full_path);

			$type = mime_content_type($storage_path);
			$size = Storage::size('public/'.$file_full_path);

			$params = [
				'path' => 'upload/'.$file_full_path
			];

			$image_extensions = ['jpg', 'jpeg', 'png'];
			if (in_array($file_extension, $image_extensions)) {
				$data = getimagesize($storage_path);
				$params["width"] = $data[0];
				$params["height"] = $data[1];
				$this->image_resize($storage_path, 200, 200);
			}

			return MediaFiles::create([
				'id_media_directory' => $id_media_directory,
				'name' => $org_file_name,
				'type' => $type,
				'size' => $size,
				'extension' => $file_extension,
				'params' => $params,
			]);
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
