@extends('layouts.app')

@section('content')
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
@endsection
