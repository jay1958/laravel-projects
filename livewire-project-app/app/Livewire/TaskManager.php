<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskManager extends Component
{
    public $tasks, $title, $task_id;
    public $isEdit = false;

    protected $rules = [
        'title' => 'required|min:3'
    ];

    // ✅ Component Load hone par tasks fetch karo
    public function mount()
    {
        $this->fetchTasks();
    }

    // ✅ Tasks ko refresh karne ka method
    private function fetchTasks()
    {
        $this->tasks = Task::latest()->get();
    }

    public function render()
    {
        return view('livewire.task-manager');
    }

    public function store()
    {
        $this->validate();
        Task::create(['title' => $this->title]);
        session()->flash('success', '✅ Task Added Successfully!');
        $this->resetForm();
        $this->fetchTasks(); // ✅ Tasks ko refresh karo
    }

    public function edit($id)
    {
        $task = Task::find($id);
        if ($task) {
            $this->task_id = $task->id;
            $this->title = $task->title;
            $this->isEdit = true;
        }
    }

    public function update()
    {
        $this->validate();
        Task::find($this->task_id)?->update(['title' => $this->title]);
        session()->flash('success', '✅ Task Updated Successfully!');
        $this->resetForm();
        $this->fetchTasks(); // ✅ Tasks ko refresh karo
    }

    public function delete($id)
    {
        Task::find($id)?->delete();
        session()->flash('success', '❌ Task Deleted Successfully!');
        $this->fetchTasks(); // ✅ Tasks ko refresh karo
    }

    private function resetForm()
    {
        $this->title = '';
        $this->task_id = '';
        $this->isEdit = false;
    }
}
