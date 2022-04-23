<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Exception;

class ImagesEdit extends Component
{
    use WithFileUploads;


    public $images = [];

    public $listeners = [
        "add_file" => 'addFile',
        "clear_files" => 'clearFiles',
        "clear_file" => 'clearFile',
    ];

    public $validation_errors = [];

    public function mount($currentFiles)
    {
        $this->images = $currentFiles;
    }

    public function addFile($image)
    {
        try {
            if (count($this->images) >= 6) {
                session()->flash("error", "Solo se pueden máximo 6 imagenes");
            } elseif ($this->getFileInfo($image)["file_type"] == "image") {
                array_push($this->images, $image);
                //Envia el array a la vista
                $this->emit('get_images', $this->images);
            } else {
                session()->flash("error", "Solo se pueden subir imagenes");
            }
        } catch (Exception $ex) {
        }
    }

    public function clearFiles()
    {
        $this->images = [];
        $this->emit('get_images', $this->images);
    }

    public function clearFile($index)
    {
        unset($this->images[$index]);
        $this->emit('get_images', $this->images);
    }

    public function getFileInfo($image)
    {
        $info = [
            "decoded_file" => NULL,
            "file_meta" => NULL,
            "file_mime_type" => NULL,
            "file_type" => NULL,
            "file_extension" => NULL,
        ];
        try {
            $info['decoded_file'] = base64_decode(substr($image, strpos($image, ',') + 1));
            $info['file_meta'] = explode(';', $image)[0];
            $info['file_mime_type'] = explode(':', $info['file_meta'])[1];
            $info['file_type'] = explode('/', $info['file_mime_type'])[0];
            $info['file_extension'] = explode('/', $info['file_mime_type'])[1];
        } catch (Exception $ex) {
        }

        return $info;
    }

    public function render()
    {
        return view('livewire.images-edit');
    }
}
