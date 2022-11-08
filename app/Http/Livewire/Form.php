<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class Form extends Component
{

    public $name;
    public $email;
    public $status;
    public $projectId;

    public $modalFormVisible = false;
    public $modalConfirmDeleteVisible = false;

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'status' => 'required',
        ];
    }

    public function mount()
    {
        // $this->resetPage();
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->resetVars();
        $this->modalFormVisible = true;
    }

    public function create()
    {
        $this->validate();
        Project::create($this->projectData());
        $this->modalFormVisible = false;
        $this->resetVars();

    }

    public function loadData()
    {
        $project = Project::find($this->projectId);
        $this->name = $project->name;
        $this->email = $project->email;
        $this->status = $project->status;
    }

    public function projectData()
    {
        return [
            'name'   => $this->name,
            'email'  => $this->email,
            'status' => $this->status,
        ];
    }

    public function read()
    {
        return Project::paginate(5);
    }

    public function resetVars()
    {
        $this->projectId = null;
        $this->name = null;
        $this->email = null;
        $this->status = null;

    }

    public function updateShowModal($id)
    {

        $this->resetValidation();
        $this->resetVars();
        $this->projectId = $id;
        $this->modalFormVisible = true;
        $this->loadData();

    }

    public function update()
    {
        $this->validate();
        Project::find($this->projectId)->update($this->projectData());
        $this->modalFormVisible = false;
    }

    public function deleteShowModal($id)
    {
        $this->projectId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    public function delete()
    {
        Project::destroy($this->projectId);
        $this->modalConfirmDeleteVisible = false;

    }

    public function render()
    {
        return view('livewire.form', [
            'data' => $this->read(),
        ]);
    }
}
