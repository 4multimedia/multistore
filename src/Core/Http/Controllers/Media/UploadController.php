<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Media;

    use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Models\MediaDirectory;
	use Str;

    class UploadController extends Controller
    {
        public function index(Request $request) {
			$array = [];
			if($request->hasFile('files')) {
				$id_media_directory = null;
				if ($request->has('hash_directory') && !empty($request->hash_directory)) {
					$id_media_directory = MediaDirectory::byHash($request->hash_directory)->id;
				}
				$files = $request->file('files');
				foreach($files as $file) {
					$org_file_name = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$file_without_extension = strtr($org_file_name, ['.'.$extension => '']);
					$file_name_clear = Str::slug($file_without_extension);

					$file_name = $file_name_clear.'_'.time().'.'.$extension;
					$directory = date('Y/m');

					$file->storeAs('public/'.$directory, $file_name);

					$array[] = media()->set_image(
						$directory.'/'.$file_name,
						$id_media_directory,
						$org_file_name
					);
				}
			}
			return $array;
        }
    }
