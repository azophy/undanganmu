@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Create new User</div>

    <div class="card-body">
        @include('user._form', [
            'model' => $model, 
            'target' => route('user.store') , 
            'method' => 'POST',
        ])
    </div>
</div>
@endsection
