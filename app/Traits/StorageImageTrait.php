<?php

namespace App\Traits;

use Storage;

trait StorageImageTrait
{
    public function storageTraitUpload($request, $fieldName, $folderName)
    {
        if ($request->hasFile($fieldName)) {

            $file = $request->$fieldName;
            $filenameOrigin = $file->getClientOriginalName();
            $filenameHash = str_random(20) . '_' . $file->getClientOriginalExtension();
            $id = auth()->id();
            $filepath = $request->file($fieldName)->storeAs('public/' . $folderName . '/' . $id, $filenameHash);

            $dataUploadTrait = [
                'file_name' => $filenameOrigin,
                'file_path' => Storage::url($filepath),
            ];
            return $dataUploadTrait;
        }
        return null;
    }

    public function storageTraitUploadMultiple($file, $folderName)
    {

        $filenameOrigin = $file->getClientOriginalName();
        $filenameHash = str_random(20) . '_' . $file->getClientOriginalExtension();
        $id = auth()->id();
        $filepath = $file->storeAs('public/' . $folderName . '/' . $id, $filenameHash);

        $dataUploadTrait = [
            'file_name' => $filenameOrigin,
            'file_path' => Storage::url($filepath),
        ];
        return $dataUploadTrait;

    }
}