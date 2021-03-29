<div class="d-flex justify-content-end">
    <a href="{{ route('users.edit', $data->id) }}" class="btn btn-outline-info btn-m rounded-circle btn-sm mx-2"><i
            class="fas fa-pencil-alt"></i></a>

    <button type="button" class="btn btn btn-outline-danger btn-m rounded-circle btn-sm mx-2"
        onclick="delPerson(`{{route('users.destroy', $data->id) }}`)"><i class="fas fa-trash-alt"></i></button>
</div>