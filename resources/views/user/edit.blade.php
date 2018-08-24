@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit User {{ $model->name }}</div>

    <div class="card-body">
        @include('user._form', [
            'model' => $model, 
            'target' => route('user.update', [
                'id' => $model->id,
            ] ), 
            'method' => 'PUT',
         ])
    </div>
</div>
@endsection
