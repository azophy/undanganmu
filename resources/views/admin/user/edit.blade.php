@extends('layouts.app')

@section('title', 'Editing User Info')

@section('content')
<div class="card">
    <div class="card-header">Edit User {{ $model->name }}</div>

    <div class="card-body">
        @include('admin.user._form', [
            'model' => $model, 
            'target' => route('admin.user.update', [
                'id' => $model->id,
            ] ), 
            'method' => 'PUT',
         ])
    </div>
</div>

<br/> <!-- ################## TEMPLATE LIST ##################### -->

<div class="card">
    <div class="card-header">Templates of user {{ $model->name }}</div>

    <div class="card-body">
        <p>
            <a class="btn btn-success" href="{{ route('admin.user.create_custom_template',['id' => $model->id]) }}">Add new custom template</a>
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model->templates as $template)
                <tr>
                    <td></td>
                    <td>{{ $template->name }}</td>
                    <td> <a href="{{ route('admin.template.edit',['id' => $template->id]) }}">Edit</a> / <a onclick="javascript:delete_element({{ $template->id }})" href="#">Delete</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function delete_element(id) {
    if (confirm('Are you sure you want to delete this?'))
        $.ajax({
            url: '{{ route('admin.template.index') }}/' + id,
            type: 'DELETE',
            data: { "_method":"DELETE","_token" : "{{ csrf_token() }}" },
            success: function(result) {
                window.location.reload();
            },
            error: function(err) {
                console.log(err);
                window.location.reload();
            }
        });
}
</script>
@endsection
