@extends('layouts.app')

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
@endsection
