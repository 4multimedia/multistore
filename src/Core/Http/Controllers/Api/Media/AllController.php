<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Api\Media;

    use App\Http\Controllers\Controller;
	use Multimedia\Multistore\Core\Http\Classes\Media;
	use Multimedia\Multistore\Core\Models\MediaDirectory;

    class AllController extends Controller
    {
		public function __construct() {
			$this->media = new Media();
		}

        public function index(MediaDirectory $mediaDirectory) {
			$array = [];
			$directory = $this->media->directoryList($mediaDirectory);
			$files = $this->media->filesList($mediaDirectory);

			$array = array_merge(
				$this->media->transformList($directory, ['id', 'hash', 'name', 'count_subdirectory', 'count_files'], ['type' => 'directory']),
				$this->media->transformList($files, ['id', 'hash', 'name', 'human_size', 'extension', 'paths'], ['type' => 'file'])
			);

			return $array;
        }
    }
