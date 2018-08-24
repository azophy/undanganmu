@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Sites {{ $model->url_name }}</div>

    <div class="card-body">
        @include('site._form', [
            'model' => $model, 
            'target' => route('site.update', [
                'id' => $model->id,
            ] ), 
            'method' => 'PUT',
         ])
    </div>
</div>
@endsection
