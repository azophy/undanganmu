@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Create new Template</div>

    <div class="card-body">
        @include('template._form', [
            'model' => $model, 
            'target' => route('template.store') , 
            'method' => 'POST',
        ])
    </div>
</div>
@endsection
