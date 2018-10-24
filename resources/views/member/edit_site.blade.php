@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Editing Sites {{ $model->url_name }}</div>

    <div class="card-body">
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="form" action="{{ route('member.update_site') }}" method="POST">
    @method('POST')
    @csrf
    <div class="form-group row">
        <label for="id_template" class="col-md-3 col-form-label">Template</label>
        <div class="col-md-9">
            {!! Form::select('id_template', \App\Template::pluck('name','id'), $model->id_template, ['class' => 'form-control']) !!}
        </div>
    </div>

    <!-- =========================================== -->
    <hr/>
    <h2>Names</h2>
    <div class="form-group row">
        <label for="option_data_bride_short_name" class="col-md-3 col-form-label">Bride Short Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_bride_short_name" name="option_data[bride_short_name]" value="{{ $model->option_data->bride_short_name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_bride_full_name" class="col-md-3 col-form-label">Bride Full Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_bride_full_name" name="option_data[bride_full_name]" value="{{ $model->option_data->bride_full_name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_bride_father_name" class="col-md-3 col-form-label">Bride Father Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_bride_father_name" name="option_data[bride_father_name]" value="{{ $model->option_data->bride_father_name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_bride_mother_name" class="col-md-3 col-form-label">Bride Mother Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_bride_mother_name" name="option_data[bride_mother_name]" value="{{ $model->option_data->bride_mother_name }}" placeholder="">
        </div>
    </div>

    <div class="form-group row">
        <label for="option_data_groom_short_name" class="col-md-3 col-form-label">Groom Short Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_groom_short_name" name="option_data[groom_short_name]" value="{{ $model->option_data->groom_short_name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_groom_full_name" class="col-md-3 col-form-label">Groom Full Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_groom_full_name" name="option_data[groom_full_name]" value="{{ $model->option_data->groom_full_name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_groom_father_name" class="col-md-3 col-form-label">Groom Father Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_groom_father_name" name="option_data[groom_father_name]" value="{{ $model->option_data->groom_father_name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_groom_mother_name" class="col-md-3 col-form-label">Groom Mother Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_groom_mother_name" name="option_data[groom_mother_name]" value="{{ $model->option_data->groom_mother_name }}" placeholder="">
        </div>
    </div>

    <!-- =========================================== -->
    <hr/>
    <h2>Event Informations</h2>
    <div class="form-group row">
        <label for="option_data_event_title" class="col-md-3 col-form-label">Event Title</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_title" name="option_data[event_title]" value="{{ $model->option_data->event_title }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_date" class="col-md-3 col-form-label">Event Date</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_date" name="option_data[event_date]" value="{{ $model->option_data->event_date }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_loc_1_name" class="col-md-3 col-form-label">Event Location Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_loc_1_name" name="option_data[event_loc_1_name]" value="{{ $model->option_data->event_loc_1_name }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_loc_1_address" class="col-md-3 col-form-label">Event Location Address</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_loc_1_address" name="option_data[event_loc_1_address]" value="{{ $model->option_data->event_loc_1_address }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_loc_1_city" class="col-md-3 col-form-label">Event Location City</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_loc_1_city" name="option_data[event_loc_1_city]" value="{{ $model->option_data->event_loc_1_city }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_loc_same" class="col-md-3 col-form-label">Event Location</label>
        <div class="col-md-9">
            {{ Form::checkbox('option_data[event_loc_same]',$model->option_data->event_loc_same, ['id' => "option_data_event_loc_same"]) }}
            <label for="">Is the same for both event</label>
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_1_title" class="col-md-3 col-form-label">Event 1 Title</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_1_title" name="option_data[event_1_title]" value="{{ $model->option_data->event_1_title }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_1_time" class="col-md-3 col-form-label">Event 1 Time</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_1_time" name="option_data[event_1_time]" value="{{ $model->option_data->event_1_time }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_2_title" class="col-md-3 col-form-label">Event 2 Title</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_2_title" name="option_data[event_2_title]" value="{{ $model->option_data->event_2_title }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_2_time" class="col-md-3 col-form-label">Event 2 Time</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="option_data_event_2_time" name="option_data[event_2_time]" value="{{ $model->option_data->event_2_time }}" placeholder="">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-9 offset-md-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
@endsection
