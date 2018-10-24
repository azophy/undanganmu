@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Edit Sites {{ $model->url_name }}</div>

    <div class="card-body">
        @include('admin.site._form', [
            'model' => $model, 
            'target' => route('admin.site.update', [
                'id' => $model->id,
            ] ), 
            'method' => 'PUT',
         ])
    </div>
</div>
@endsection
