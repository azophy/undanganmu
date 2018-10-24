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

<form class="form" action="{{ $target }}" method="POST">
    @method($method)
    @csrf
    <div class="form-group row">
        <label for="name" class="col-md-3 col-form-label">Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="name" value="{{ $model->name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="username" class="col-md-3 col-form-label">Username</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="username" name="username" value="{{ $model->username }}" placeholder="">
        </div>
    </div>
    {{-- @if (empty($model->password)) --}}
    <div class="form-group row">
        <label for="password" class="col-md-3 col-form-label">{{ (!empty($model->password)) ? 'New ' : '' }}Password</label>
        <div class="col-md-9">
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" value="" placeholder="">
              <span class="input-group-btn">
                <button class="btn btn-secondary" id="show-password" type="button"><i class="far fa-eye"></i></button>
              </span>
            </div>
        </div>
    </div>
    {{-- @endif --}}
    <div class="form-group row">
        <label for="email" class="col-md-3 col-form-label">E-mail</label>
        <div class="col-md-9">
            <input type="email" class="form-control" id="email" name="email" value="{{ $model->email }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="id_role" class="col-md-3 col-form-label">User Role</label>
        <div class="col-md-9">
            {!! Form::select('id_role', \App\User::listConstants('ROLE_'), $model->id_role, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-9 offset-md-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>


@section('script_bottom')
$(document).ready(function() {
    $('#show-password').on('click', function(e) {
        if ($('#password').attr('type') == 'password')
            $('#password').attr('type','text');
        else
            $('#password').attr('type','password');
    });
});
@endsection
