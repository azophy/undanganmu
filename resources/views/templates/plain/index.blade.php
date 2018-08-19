<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pernikahan {{ $info->name_bride }} dan {{ $info->name_groom }}</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="{{ asset('templates/plain') }}/css/main.css" rel="stylesheet">

    <style>
    #list_pesan_wall {
        overflow-y: scroll;
        height: 300px;
        background: #fff;
    }
    .pesan_box {
        border: 1px solid #eee;
        padding: 0.5em;
        margin: 0.5em;
        background: #eee;
    }

    .pesan_box .sender {
        color: red;
    }
    </style>

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">{{ $info->name_bride }} & {{ $info->name_groom }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#information">Informasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#location">Denah Lokasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#rsvp">RSVP</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="bg-primary text-white">
      <div class="container text-center">
        <h1>{{ $info->name_bride }} & {{ $info->name_groom }}</h1>
        <p class="lead">{{ $info->date }} @ {{ $info->location->city }}</p>
      </div>
    </header>

    <section id="information">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>Informasi Acara</h2>
            <p class="lead">Insya Allah akan dilaksanakan pada :</p>
            <ul>
              <li>Hari: {{ $info->date }}</li>
              <li>Jam: 
                <ul>
                    @foreach ($info->events as $event)
                    <li>{{ $event->title }}: {{ $event->time }}</li>
                    @endforeach
                </ul> </li>
              <li>Tempat: {{ $info->location->name }}, {{ $info->location->city }}</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="location" class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <h2>Denah Lokasi</h2>
            
            Denah lokasi: <a href="{{ url('/'.$site->url_name.'/lokasi') }}">{{ url('/'.$site->url_name.'/lokasi') }}</a>
            <iframe src="https://www.google.com/maps/embed?pb={{ $info->location->google_map_embed_param }}" style="width:100%;height:80vh" frameborder="0" style="border:0" allowfullscreen></iframe>

          </div>
        </div>
      </div>
    </section>

<?php
// use this instagram access token generator http://instagram.pixelunion.net/
$access_token_1=env('IG_ACCESS_TOKEN_1');
$access_token_2=env('IG_ACCESS_TOKEN_2');
$photo_count=9;
     
$json_link_1="https://api.instagram.com/v1/users/self/media/recent/?";
$json_link_1.="access_token={$access_token_1}&count={$photo_count}";
$json_link_2="https://api.instagram.com/v1/users/self/media/recent/?";
$json_link_2.="access_token={$access_token_2}&count={$photo_count}";

function display_feed($link) {
$json = file_get_contents($link);
$obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);

echo "<div class='item_box'>";
foreach ($obj['data'] as $post) :
     
    $pic_text=$post['caption']['text'];
    $pic_link=$post['link'];
    $pic_like_count=$post['likes']['count'];
    $pic_comment_count=$post['comments']['count'];
    $pic_src=str_replace("http://", "https://", $post['images']['standard_resolution']['url']);
    $pic_created_time=date("F j, Y", $post['caption']['created_time']);
    $pic_created_time=date("F j, Y", strtotime($pic_created_time . " +1 days"));

    /*

        <p>
            <p>
                <div style='color:#888;'>
                <a href='<?=$pic_link?>' target='_blank'><?=$pic_created_time?></a>
                </div>
            </p>
            <p><?=$pic_text?></p>
        </p>
     */
?>
    <div class='row'>        
        <a href='<?=$pic_link?>' target='_blank'>
            <img class='img-responsive photo-thumb' src='<?=$pic_src?>' alt='<?=$pic_text?>'>
        </a>
    </div>
<?php endforeach; 
echo "</div>";
} ?>
<style>
.item_box{
    height:100vh;
    overflow-y: scroll;
}
 
.photo-thumb{
    width:100%;
    height:auto;
    float:left; 
    border: thin solid #d1d1d1;
    margin:0 1em .5em 0;
    float:left; 
}
</style>
<?php /*
    <section id="socmed">
      <div class="container">
        <center><h2>Social Media</h2></center>
        <div class="row">
          <div class="col-md-6 ">
            <h3>Feed Instagram Hilya</h3>
            <?=display_feed($json_link_2)?>
          </div>
          <div class="col-md-6">
            <h3>Feed Instagram Yahya</h3>
            <?=display_feed($json_link_1)?>
          </div>
        </div>
      </div>
    </section>
 */ ?>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Website by <a href="http://undangan.mu">Undangan.mu</a> &copy; <script type="text/javascript">var cur = 2018; var year = new Date(); if(cur == year.getFullYear()) year = year.getFullYear(); else year = cur + ' - ' + year.getFullYear(); document.write(year);</script></p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Plugin JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="{{ asset('templates/plain') }}/js/main.js"></script>

  </body>

</html>
