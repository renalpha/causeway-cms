<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostUploadRequest;
use Domain\Services\UploadService;

class UploadController extends Controller
{
    /** @var UploadService $uploadService */
    protected $uploadService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function upload(PostUploadRequest $request)
    {
        $file = isset($request->file) ? $this->uploadService->upload($request->file, $this->uploadService->uploadPhotoPath) : null;
        return url($file->file_path);
    }
}
