@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
        </div>
    </div>
</div>
@endsection
