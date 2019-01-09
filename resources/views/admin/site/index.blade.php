@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Sites on undanganmu</div>

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
            <a class="btn btn-primary" href="{{ route('admin.site.create') }}">Add new</a>
        </p>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Url Name</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sites as $site)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $site->id_user }}</td>
                    <td>{{ $site->url_name }}</td>
                    <td>{{ $site->option_data->event_title }}</td>
                    <td> <a href="{{ route('admin.site.edit',['id' => $site->id]) }}">Edit</a> / <a onclick="javascript:delete_element({{ $site->id }})" href="#">Delete</a> </td>
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
