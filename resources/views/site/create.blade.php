@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new Sites</div>

                <div class="card-body">
                    @include('site._form', [
                        'model' => $model, 
                        'target' => route('site.store') , 
                        'method' => 'POST',
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
