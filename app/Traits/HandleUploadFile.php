<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HandleUploadFile {

    protected string $disk = 'dropbox';

    public function handleUpload($path, $file_new, $file_current = null) {
        if(!empty($file_current)) {
            $this->deleteFile($file_current);
        }
        return $this->upload($path, $file_new);
    }

    public function upload($path, $file) {
        return Storage::disk($this->disk)->put($path, $file);
    }

    public function deleteFile($file) {
        if(Storage::disk('dropbox')->exists($file)) {
            return Storage::disk($this->disk)->delete($file);
        }
        return false;
    }

}
