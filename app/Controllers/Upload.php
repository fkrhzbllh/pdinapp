<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Upload extends BaseController
{
    public function uploadImage()
    {
        $file = $this->request->getFile('file');

        dd($file);
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);

            $response = [
                'location' => base_url('uploads/' . $newName),
            ];

            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid file']);
        }
    }
}
