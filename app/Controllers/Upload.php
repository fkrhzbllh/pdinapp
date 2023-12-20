<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Upload extends BaseController
{
    public function uploadImage()
    {
        $file = $this->request->getFile('file');

        // dd($file);
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            // $file->move('uploads');
            $file->move(ROOTPATH . 'public/uploads', $newName);

            $response = [
                'location' => base_url('uploads/' . $newName),
            ];

            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid file']);
        }
    }

    public function deleteImage()
    {
        $imageUrl = $this->request->getVar('image_url');

        dd($imageUrl);
        // Extract the filename from the URL
        $filename = pathinfo($imageUrl, PATHINFO_BASENAME);

        // Construct the full server path
        $filePath = ROOTPATH . 'public/uploads/' . $filename;

        // Check if the file exists before attempting to delete
        if (file_exists($filePath)) {
            unlink($filePath);

            return $this->response->setStatusCode(200)->setJSON(['message' => 'Image deleted successfully']);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Image not found']);
        }
    }
}
