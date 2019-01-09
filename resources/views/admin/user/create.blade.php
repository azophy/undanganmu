@extends('layouts.app')

@section('title', 'Create new user')

@section('content')
<div class="card">
    <div class="card-header">Create new User</div>

    <div class="card-body">
        @include('admin.user._form', [
            'model' => $model, 
            'target' => route('admin.user.store') , 
            'method' => 'POST',
        ])
    </div>
</div>
@endsection
