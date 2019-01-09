@extends('layouts.app')

@section('title', 'Create new custom template')

@section('content')
<div class="card">
    <div class="card-header">Create new custom template</div>

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

        <form class="form" action="{{ route('admin.user.store_custom_template',['user' => $user->id]) }}" method="POST">
            @method('POST')
            @csrf
            <div class="form-group row">
                <label for="base_template_id" class="col-md-3 col-form-label">Base Template</label>
                <div class="col-md-9">
                    {!! Form::select('base_template_id', $user->available_template_list, null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label">Template Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="name" name="name" value="" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="path" class="col-md-3 col-form-label">Template Path</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="path" name="path" value="" placeholder="">
                </div>
            </div>
            <div class="form-group row">
                <label for="type" class="col-md-3 col-form-label">Template Type</label>
                <div class="col-md-9">
                    {!! Form::select('type', 
                            \App\Template::$TYPE_LABEL, 
                            null, 
                            ['class' => 'form-control']
                    ) !!}
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-3 col-form-label">Description</label>
                <div class="col-md-9">
                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9 offset-md-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
