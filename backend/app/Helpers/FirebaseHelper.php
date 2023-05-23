<?php

namespace App\Helpers;

use DateInterval;
use DateTime;

class FirebaseHelper
{
    protected function getImagePathFromUrl($imageUrl, $path_direct)
    {
        $path_director  = $path_direct;
        $parts = parse_url($imageUrl);
        $path = trim($parts['path'], '/');
        $fileName = basename($path);
        return $path_director . $fileName;
    }
    public function deleteImage($imageUrl, $path_direct)
    {
        $object = app('firebase.storage')->getBucket()->object($this->getImagePathFromUrl($imageUrl, $path_direct));

        return $object->delete();
    }
    public function uploadimageToFireBase($image, $path)
    {
        $student = app('firebase.firestore')->database()->collection('Images')->newDocument();
        $firebase_storage_path = $path;
        $name = $student->id();
        $localfolder = public_path('firebase-temp-uploads') . '/';
        $extension = $image->getClientOriginalExtension();
        $file = $name . '.' . $extension;
        if ($image->move($localfolder, $file)) {
            $uploadedfile = fopen($localfolder . $file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $firebase_storage_path . $file]);
            unlink($localfolder . $file);
        }
        $time = new DateTime();
        $expiresAt = $time->add(new DateInterval('P3Y'));
        return app('firebase.storage')->getBucket()->object($firebase_storage_path . $file)->signedUrl($expiresAt);
    }
}
