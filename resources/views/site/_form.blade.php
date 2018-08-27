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
    <div class="form-group row">
        <label for="page_title" class="col-md-3 col-form-label">Page Title</label>
        <div class="col-md-9">
            <input type="text" class="form-control" id="page_title" name="page_title" value="{{ $model->page_title }}" placeholder="">
        </div>
    </div>
{{--
    <div class="form-group row">
        <label for="option" class="col-md-3 col-form-label">Options</label>
        <div class="col-md-9">
            <textarea class="form-control" id="option" name="option" rows="5">{{ $model->option }}</textarea>
        </div>
    </div>
--}}
    <hr/>
    <label for="">Options</label>
<?php if (!empty($model->option)) 
print_option($model->option_data); 
else print_option($model::$option_default) ?>
    <div class="form-group row">
        <div class="col-md-9 offset-md-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
