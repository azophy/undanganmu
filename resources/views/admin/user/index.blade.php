@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Users on undanganmu</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p>
            <a class="btn btn-primary" href="{{ route('admin.user.create') }}">Add new</a>
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role() }}</td>
                    <td> <a href="{{ route('admin.user.edit',['id' => $user->id]) }}">Edit</a> / <a onclick="javascript:delete_element({{ $user->id }})" href="#">Delete</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script_bottom')
function delete_element(id) {
    if (confirm('Are you sure you want to delete this?'))
        $.ajax({
            url: '{{ Request::url() }}/' + id,
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
@endsection
