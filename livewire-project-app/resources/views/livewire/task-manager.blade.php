<div class="container mt-4">
    <h2 class="text-center mb-4">Livewire CRUD - Task Manager</h2>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card p-3">
        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
            <input type="text" class="form-control mb-2" wire:model="title" placeholder="Enter Task Title">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror

            <button type="submit" class="btn btn-{{ $isEdit ? 'success' : 'primary' }}">
                {{ $isEdit ? 'Update Task' : 'Add Task' }}
            </button>
        </form>
    </div>

    <ul class="list-group mt-3">
        @if($tasks && count($tasks) > 0)
        @foreach($tasks as $task)
            <li class="list-group-item d-flex justify-content-between">
                {{ $task->title }}
                <div>
                    <button wire:click="edit({{ $task->id }})" class="btn btn-sm btn-warning">Edit</button>
                    <button wire:click="delete({{ $task->id }})" class="btn btn-sm btn-danger">Delete</button>
                </div>
            </li>
        @endforeach
    @else
        <li class="list-group-item">No tasks found</li>
    @endif
    
    </ul>
</div>
