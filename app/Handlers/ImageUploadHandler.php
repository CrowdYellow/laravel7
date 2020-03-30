<?php
namespace App\Handlers;

use  Illuminate\Support\Str;

class ImageUploadHandler
{
    // 只允许以下后缀名的图片文件上传
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        $folder_name = "uploads/$folder/" . date("Ym/d", time());
        $upload_path = public_path() . '/' . $folder_name;
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }
        $file->move($upload_path, $filename);
        return [
            'path' => "/$folder_name/$filename"
        ];
    }
}
