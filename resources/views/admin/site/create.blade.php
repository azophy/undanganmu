@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Create new Sites</div>

    <div class="card-body">
        @include('admin.site._form', [
            'model' => $model, 
            'target' => route('admin.site.store') , 
            'method' => 'POST',
        ])
    </div>
</div>
@endsection
