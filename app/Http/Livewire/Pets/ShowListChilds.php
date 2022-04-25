<?php

namespace App\Http\Livewire\Pets;

use App\Models\Pet;
use Livewire\Component;

class ShowListChilds extends Component
{
    public $search;
    public $currents = [];
    public $pet_id; //parent
    public $pet_name; //parent
    public $pet_sex; //parent
    public $delete = false;

    public function mount($currentsPets, $pet_id, $pet_name, $pet_sex, $delete)
    {
        $this->search = '';
        $this->currents = $currentsPets;
        $this->pet_id = $pet_id;
        $this->pet_name = $pet_name;
        $this->pet_sex = $pet_sex;
        $this->delete = $delete;
    }

    public function reset_search()
    {
        $this->search = '';
    }

    public function render()
    {
        sleep(1);

        return view('livewire.pets.show-list-childs', [
            'pets' =>  $this->getChilds($this->search)
        ]);
    }
    public function getChilds($search)
    {
        if ($this->pet_sex == 'M') {
            return  Pet::where('id_pet_pather', $this->pet_id)
                ->where(function ($query) use ($search) {
                    return $query->where('name', 'LIKE', '%' .  ucwords(strtolower($search)) . '%')
                        ->orWhere('pet_id', 'LIKE', '%' . strtoupper($search) . '%');
                })->get();
        } else {
            return Pet::where('id_pet_mother', $this->pet_id)
                ->where(function ($query) use ($search) {
                    return $query->where('name', 'LIKE', '%' .  ucwords(strtolower($search)) . '%')
                        ->orWhere('pet_id', 'LIKE', '%' . strtoupper($search) . '%');
                })->get();
        }
    }
}
