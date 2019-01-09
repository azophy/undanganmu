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
        <label for="id_user" class="col-md-3 col-form-label">Template Owner Id</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="id_user" value="{{ $model->id_user }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-md-3 col-form-label">Template Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="name" name="name" value="{{ $model->name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="path" class="col-md-3 col-form-label">Template Path</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="path" name="path" value="{{ $model->path }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="type" class="col-md-3 col-form-label">Template Type</label>
        <div class="col-md-9">
            {!! Form::select('type', 
                    \App\Template::$TYPE_LABEL, 
                    $model->type, 
                    ['class' => 'form-control']
            ) !!}
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-md-3 col-form-label">Description</label>
        <div class="col-md-9">
            <textarea class="form-control" id="description" name="description" rows="5">{{ $model->description }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-9 offset-md-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
