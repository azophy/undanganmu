@php
/*
Store useful functions which is called by bootstrap/app.php
Ref: https://stackoverflow.com/a/28383097
*/

function asset_url($param) { 
    if (Request::secure()) 
        return secure_asset($param); 
    else
        return asset($param); 
}
@endphp
