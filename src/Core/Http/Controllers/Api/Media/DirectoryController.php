<?php

    namespace Multimedia\Multistore\Core\Http\Controllers\Api\Media;

    use App\Http\Controllers\Controller;
	use Multimedia\Multistore\Core\Http\Classes\Media;
	use Illuminate\Http\Request;
	use Multimedia\Multistore\Core\Http\Requests\Media\Directory\StoreRequest;
	use Multimedia\Multistore\Core\Models\MediaDirectory;

    class DirectoryController extends Controller
    {
		public function __construct() {
			$this->media = new Media();
		}

        public function index(MediaDirectory $mediaDirectory) {
			return $this->media->directoryList($mediaDirectory);
        }

		public function store(StoreRequest $request, MediaDirectory $mediaDirectory) {
			return $this->media->directoryStore($request, $mediaDirectory);
		}

		public function view(MediaDirectory $mediaDirectory) {
			$mediaDirectory->path = $mediaDirectory->path;
            return $mediaDirectory;
		}

		public function restore(StoreRequest $request, MediaDirectory $mediaDirectory) {
			return $this->media->directoryRestore($request, $mediaDirectory);
		}

		public function delete(MediaDirectory $mediaDirectory) {
			return $this->media->directoryDelete($mediaDirectory);
		}

		public function trash() {
			return $this->media->directoryTrashed();
		}
    }
