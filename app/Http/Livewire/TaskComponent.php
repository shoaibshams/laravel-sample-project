<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class TaskComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;

    public $edit_name, $edit_id;

    public $delete_id;

    protected $listeners = ['deleteTask' => 'deleteTask'];

    public function saveTask()
    {
        $this->validate(['name' => 'required|string|min:3|max:255']);

        Task::create(['name' => $this->name]);

        session()->flash('message', 'Successfully saved');

        $this->name = '';
    }

    public function setDeleteId($id)
    {
        $this->delete_id = $id;
    }

    public function deleteTask()
    {
        Task::where('id', $this->delete_id)->delete();
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        $this->edit_id = $task->id;
        $this->edit_name = $task->name;
    }

    public function updateTask()
    {
        $this->validate(['edit_name' => 'required|string|min:3|max:255']);

        Task::where('id', $this->edit_id)->update(['name' => $this->edit_name]);

        session()->flash('message', 'Successfully updated');

        $this->edit_id = '';
        $this->edit_name = '';
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.task', [
            'tasks' => Task::latest()->paginate(5)
        ]);
    }
}
