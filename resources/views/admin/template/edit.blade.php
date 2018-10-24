@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Template {{ $model->name }}</div>

    <div class="card-body">
        @include('admin.template._form', [
            'model' => $model, 
            'target' => route('admin.template.update', [
                'id' => $model->id,
            ] ), 
            'method' => 'PUT',
         ])
    </div>
</div>
@endsection
