<?php

namespace App\config;

use Cloudinary\Cloudinary;

class CloudinaryService
{
    private $cloudinary;

    /**
     * Initializes the CloudinaryService instance.
     *
     * Sets up the Cloudinary connection using environment variables.
     */
    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
                'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
                'api_secret' => $_ENV['CLOUDINARY_API_SECRET']
            ]
        ]);
    }

    /**
     * Uploads a file to Cloudinary.
     *
     * @param string $file The file to upload.
     * @return string|false Returns the secure URL of the uploaded image, or false on failure.
     */
    public function uploadFile($file)
    {
        try {
            $result = $this->cloudinary->uploadApi()->upload($file, [
                'folder' => 'habitats/'
            ]);
            return $result['secure_url'];
        } catch (\Exception $e) {
            error_log("Cloudinary upload error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Deletes a file from Cloudinary by its public ID.
     *
     * @param string $publicId The public ID of the file to delete.
     * @return bool Returns true if the file was deleted, false otherwise.
     */
    public function deleteFile($publicId)
    {
        try {
            $this->cloudinary->uploadApi()->destroy($publicId);
            return true;
        } catch (\Exception $e) {
            error_log("Cloudinary delete error: " . $e->getMessage());
            return false;
        }
    }
}