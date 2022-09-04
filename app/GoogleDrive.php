<?php

namespace App;

class GoogleDrive
{
    public $client = null;
    public $drive = null;
    public $serviceFile = null;
    public $servicePermission = null;
    public $from_api = false;

    public function __construct()
    {
        $this->client = new \Google_Client();

        $jsonKey = [
            'type' => env('GOOGLE_TYPE_ACCOUNT'),
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_email' => env('GOOGLE_CLIENT_EMAIL'),
            'private_key' => env('GOOGLE_PRIVATE_KEY')
        ];
        $this->client->setAuthConfig($jsonKey);
        $this->client->setScopes([env('GOOGLE_SCOPES')]);

        $this->drive = new \Google_Service_Drive($this->client);
    }

    /**
     * It creates a new permission object, sets the type to anyone and the role to reader, then creates
     * the permission on the file with the given id
     * 
     * @param id The id of the file you want to assign the permission to.
     */
    public function AssignPermissionToFile($id)
    {
        $this->servicePermission = new \Google_Service_Drive_Permission($this->client);
        $this->servicePermission->setType('anyone');
        $this->servicePermission->setRole('reader');
        $this->drive->permissions->create($id, $this->servicePermission);
    }

    /**
     * It uploads a file to Google Drive and returns an array with the file's ID, name, mimeType, and a
     * link to the file.
     * 
     * @param file The file you want to upload.
     * 
     * @return The file ID, name, mimeType, and url.
     */
    public function uploadFile($file)
    {

        $this->serviceFile = new \Google_Service_Drive_DriveFile($this->client);
        $this->serviceFile->setName($this->getName($file));
        $this->serviceFile->setDescription($this->getName($file));
        $this->serviceFile->setMimeType($this->getMimeType($file));
        $this->serviceFile->setParents([env('GOOGLE_DRIVE_FOLDER_ID')]);

        $result = $this->drive->files->create($this->serviceFile, [
            'data' => file_get_contents($file),
            'mimeType' => 'image/png',
            'uploadType' => 'media'
        ]);

        $this->AssignPermissionToFile($result->id);

        return [
            'id' => $result->id,
            'name' => $result->name,
            'mimeType' => $result->mimeType,
            'url' => $this->getLink($result->id),
        ];
    }

    /**
     * It takes the ID of a Google Drive file and returns a link to the file
     * 
     * @param id The ID of the file you want to download.
     * 
     * @return The link to the file.
     */
    public function getLink($id)
    {
        return 'https://drive.google.com/uc?id=' . $id . '&export=view';
    }


    /**
     * It deletes a file from Google Drive
     * 
     * @param id The ID of the file to delete.
     */
    public function deleteFile($id)
    {
        $this->drive->files->delete($id);
    }

    public function getMimeType($file)
    {
        if ($this->from_api) {
            return isset($file['type']) ? $file['type'] : $this->getExtensionFromName($file['name']);
        }
        return $file->getMimeType();
    }

    public function getName($file)
    {
        return $this->from_api ? $file['name'] : $file->getClientOriginalName();
    }

    public function getExtensionFromName($name)
    {
        return pathinfo($name, PATHINFO_EXTENSION);
    }
}
