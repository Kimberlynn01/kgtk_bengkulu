<?php

namespace App\Library;

use Exception;
use Illuminate\Http\Request;

class UploadFile
{
    /**
     * @param $request request object from validation or original request object
     * @param $config array with upload configuration value, (input_name, path, allowed_extension, and disk)
     */
    public static function store(Request $request, array $config = null)
    {
        $allowedMime =  ['image/gif', 'image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'text/plain', 'image/vnd.adobe.photoshop', 'application/postscript'];

        $dangerousMime = ['application/x-msdownload', 'application/x-executable', 'application/octet-stream', 'application/x-msdos-program', 'application/x-msi', 'application/x-msdos-executable', 'application/x-ms-shortcut', 'application/x-sh', 'application/x-shar', 'application/x-shellscript', 'application/x-msdownload', 'application/x-apple-diskimage', 'application/x-debian-package', 'application/x-redhat-package-manager', 'application/vnd.android.package-archive', 'application/java-archive', 'application/x-executable', 'application/x-executable-archive', 'application/x-python', 'application/x-php', 'application/bat'];

        try {
            if (empty($config)) {
                throw new Exception("Configurasi upload tidak boleh kosong", 1);
            }

            $config = (object) $config;

            if (property_exists($config, 'input_name') === false) {
                throw new Exception("Tidak ada file untuk dibaca", 1);
            }

            $inputName = $config->input_name;

            if ($request->hasFile($inputName) === false) {
                throw new Exception("File kosong", 1);
            }

            if (property_exists($config, 'path') === false) {
                throw new Exception("Path tidak boleh kosong", 1);
            }

            $path = $config->path;
            if (empty($path)) {
                throw new Exception("Path tidak boleh kosong", 1);
            }

            if (property_exists($config, 'allowed_extension') === false) {
                $allowedExtension = ['pdf'];
            } else {
                $allowedExtension = $config->allowed_extension;
            }

            $disk = 'public';
            if (property_exists($config, 'disk')) {
                $disk = $config->disk;
            }

            $file = $request->file($inputName);

            $newFileName = time() . '-' . bin2hex(random_bytes(8)) . '.' . $file->getClientOriginalExtension();
            $ext = $file->extension();
            $size = $file->getSize();

            // Get MIME types
            $clientMimeType = $file->getClientMimeType();
            $contentMimeType = $file->getMimeType();

            // Validate against allowed MIME types
            if (!in_array($contentMimeType, $allowedMime)) {
                throw new Exception("Tipe file tidak diizinkan berdasarkan konten file", 1);
            }

            // Check for dangerous MIME types
            if (in_array($contentMimeType, $dangerousMime) || in_array($clientMimeType, $dangerousMime)) {
                throw new Exception("Tipe file berbahaya tidak diizinkan", 1);
            }

            // Optional: Cross-check client MIME type
            if ($clientMimeType !== $contentMimeType) {
                throw new Exception("Tipe file yang diberikan tidak sesuai dengan konten file", 1);
            }

            if (in_array($ext, $allowedExtension) === false) {
                throw new Exception("Jenis file tidak dikenali", 1);
            }

            $uploadedFilePath = $file->storeAs($path, $newFileName, $disk);

            return (object) [
                'status' => true,
                'message' => 'File berhasil diupload',
                'data' => [
                    'original_name' => $file->getClientOriginalName(),
                    'filename' => $newFileName,
                    'ext' => $ext,
                    'size' => $size,
                    'path' => $uploadedFilePath,
                ]
            ];
        } catch (\Throwable $th) {
            return (object) [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }
}
