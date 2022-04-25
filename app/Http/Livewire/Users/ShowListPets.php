<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use App\Models\Pet;

class ShowListPets extends Component
{
    public $search;
    public $currents = [];
    public $user_id;
    public $delete = false;

    public function mount($currentsPets, $user_id, $delete)
    {
        $this->search = '';
        $this->currents = $currentsPets;
        $this->user_id = $user_id;
        $this->delete = $delete;
    }

    public function reset_search()
    {
        $this->search = '';
    }


    public function render()
    {
        $search = $this->search;

        sleep(1);

        return view('livewire.users.show-list-pets', [
            'pets' =>
            Pet::where('user_id', $this->user_id)
                ->where(function ($query) use ($search) {
                    return $query->where('name', 'LIKE', '%' .  ucwords(strtolower($search)) . '%')
                        ->orWhere('pet_id', 'LIKE', '%' . strtoupper($search) . '%');
                })->get()
        ]);
    }
}
