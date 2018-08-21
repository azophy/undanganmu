@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        <a class="btn btn-primary" href="{{ route('template.create') }}">Add new</a>
                    </p>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Path</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($templates as $template)
                            <tr>
                                <td></td>
                                <td>{{ $template->name }}</td>
                                <td>{{ $template->path }}</td>
                                <td>{{ $template->description }}</td>
                                <td> <a href="{{ route('template.edit',['id' => $template->id]) }}">Edit</a> / <a onclick="javascript:delete_element({{ $template->id }})" href="#">Delete</a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>
@endsection
