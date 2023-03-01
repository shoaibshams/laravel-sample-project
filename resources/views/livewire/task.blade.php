<div>
    <div class="card card-purple">
        <div class="card-header">
            <h3 class="card-title">Tasks</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="saveTask">
                <div class="d-flex flex-wrap">
                    @if (session()->has('message'))
                        <div class="w-100 text-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @error('name')<div class="w-100 text-danger">{{ $message }}</div>@enderror
                    <div class="flex-grow-1">
                        <input type="text" class="form-control w-100" id="name" wire:model.lazy="name" placeholder="Type the task name here" />
                    </div>
                    <div>
                        <button type="submit" class="btn bg-gradient-purple ml-1">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">Tasks List</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $index => $task)
                    <tr>
                        <td>{{ $index + $tasks->firstItem() }}.</td>
                        <td>{{ $task->name }}</td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModal" wire:click="editTask({{ $task->id }})">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete" wire:click="setDeleteId({{ $task->id }})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $tasks->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="updateTask">
                    <div class="modal-body">
                        <div>
                            <input type="text" class="form-control w-100" wire:model.lazy="edit_name"
                                   placeholder="Type the task name here"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-purple">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
