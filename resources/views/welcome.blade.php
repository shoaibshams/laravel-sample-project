<x-layout>
    <x-slot name="page_name">Tasks</x-slot>
    <div class="row">
        <div class="col-md-6">
            <livewire:task-component />
        </div>
    </div>

    <x-slot name="script">
        <script>
            window.addEventListener('close-modal', event => {
                $('#editModal').modal('hide');
            })
            $(document).ready(function () {
                $('.delete').click(function () {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emit('deleteTask')
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                })
            })
        </script>
    </x-slot>
</x-layout>
