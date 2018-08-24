@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Template {{ $model->name }}</div>

    <div class="card-body">
        @include('template._form', [
            'model' => $model, 
            'target' => route('template.update', [
                'id' => $model->id,
            ] ), 
            'method' => 'PUT',
         ])
    </div>
</div>
@endsection
