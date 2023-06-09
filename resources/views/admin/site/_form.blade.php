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

<?php
function print_option($data, $prefix=[]) {
    foreach ($data as $key => $val) {
        if (is_array($val) || is_object($val))
            print_option($val, array_merge($prefix, [$key]));
        else {
            $name = 'option_data'; 
            $id = 'option_data'; 
            $label='';
            foreach (array_merge($prefix, [$key]) as $index => $item) {
                $name.='['.$item.']';
                $id .= '_'.$item;
                if ($index > 0) $label.= '->';
                $label .= ucfirst($item);
            } 
            ?>
    <div class="form-group row">
        <label for="<?=$id?>" class="col-md-3 col-form-label"><?=$label?></label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="<?=$id?>" name="<?=$name?>" value="<?=$val?>" placeholder="">
        </div>
    </div>
<?php
        }
    }
} ?>


<form class="form" action="{{ $target }}" method="POST">
    @method($method)
    @csrf
    <div class="form-group row">
        <label for="id_user" class="col-md-3 col-form-label">User Id</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="id_user" name="id_user" value="{{ $model->id_user }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="id_template" class="col-md-3 col-form-label">Template</label>
        <div class="col-md-9">
            {!! Form::select('id_template', \App\Template::pluck('name','id'), $model->id_template, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        <label for="url_name" class="col-md-3 col-form-label">Url Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="url_name" name="url_name" value="{{ $model->url_name }}" placeholder="">
        </div>
    </div>
    {{--
    <div class="form-group row">
        <label for="page_title" class="col-md-3 col-form-label">Page Title</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="page_title" name="page_title" value="{{ $model->page_title }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option" class="col-md-3 col-form-label">Options</label>
        <div class="col-md-9">
            <textarea class="form-control" id="option" name="option" rows="5">{{ $model->option }}</textarea>
        </div>
    </div>
--}}

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
    <!--
    <div class="form-group row">
        <label for="option_data_event_loc_1_lat" class="col-md-3 col-form-label">Event Location Lattitude</label>
        <div class="col-md-9">
            <input type="text" id="option_data_event_loc_1_lat" name="option_data[event_loc_1_lat]" value="{{ $model->option_data->event_loc_1_lat }}" placeholder="">
        </div>
    </div>
    <div class="form-group row">
        <label for="option_data_event_loc_1_long" class="col-md-3 col-form-label">Event Location Longitude</label>
        <div class="col-md-9">
            <input type="text" id="option_data_event_loc_1_long" name="option_data[event_loc_1_long]" value="{{ $model->option_data->event_loc_1_long }}" placeholder="">
        </div>
    </div>
    -->
    <div class="form-group row">
        <label for="event_map" class="col-md-3 col-form-label">Event Location Coordinate</label>
        <div class="col-md-9">
            <input type="hidden" id="option_data_event_loc_1_lat" name="option_data[event_loc_1_lat]" value="{{ $model->option_data->event_loc_1_lat }}" placeholder="">
            <input type="hidden" id="option_data_event_loc_1_long" name="option_data[event_loc_1_long]" value="{{ $model->option_data->event_loc_1_long }}" placeholder="">
            <p>(click on map to change coordinate)</p>
            <div id="event_map" style="width:100%;height:60vh;border:0"></div>
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
<script>
// Initialize and add the map
var map, marker = null;
function initMap() {
    var tengah_indonesia = {lat: -1.067975, lng: 116.8087373},
        @if($model->option_data->event_loc_1_lat)
        koordinat = {lat: {{ $model->option_data->event_loc_1_lat }}, lng: {{ $model->option_data->event_loc_1_long }}};
        @else
        koordinat = null;
        @endif
    map = new google.maps.Map(document.getElementById('event_map'), {
        zoom: 5, 
        center: tengah_indonesia,
    });

    if (koordinat != null) {
        marker = new google.maps.Marker({
          position: koordinat,
          map: map,
          draggable: true,
        });
        google.maps.event.addListener(marker, "drag", update_coordinate_input);
        map.setZoom(17);
        map.setCenter(koordinat);
    }

    google.maps.event.addListener(map, "click", function(event) {
        if (marker == null) {
            //console.log('marker is null');
            marker = new google.maps.Marker({
              position: event.latLng,
              map: map,
              draggable: true,
            });

            google.maps.event.addListener(marker, "drag", update_coordinate_input);
        } else {
            //console.log('marker not null');
            marker.setPosition(event.latLng);
        }
        update_coordinate_input();
    });
}

function update_coordinate_input(event) {
    var latlng = marker.getPosition();
    //console.log(marker);
    //console.log(latlng);
    $('#option_data_event_loc_1_lat').val(latlng.lat());
    $('#option_data_event_loc_1_long').val(latlng.lng());
}
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API_KEY') }}&callback=initMap"></script>
