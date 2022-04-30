<?php

namespace App\Http\Livewire;

use Livewire\Component;
use OwenIt\Auditing\Models\Audit as ModelsAudit;
use Livewire\WithPagination;

class Auditions extends Component
{
    use WithPagination;


    public $search = '';
    public $currents = [];

    public function mount($currentsAudit)
    {
        $this->currents = $currentsAudit;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function reset_search()
    {
        $this->search = '';
    }

    public function render()
    {
        $audits = ModelsAudit::where('id', 'LIKE', '%' .  $this->search . '%')
            ->orWhere('user_id', 'LIKE', '%' .  $this->search . '%')
            ->orWhere('auditable_id', 'LIKE', '%' . strtoupper($this->search) . '%')
            ->orWhere('event', 'LIKE', '%' .  strtolower($this->search) . '%')->orderBy('id', 'desc')->paginate(25);

        return view('livewire.auditions', ['audits' => $audits]);
    }
}
