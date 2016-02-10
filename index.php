<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Samuel Navas Medrano">
    <link rel="icon" type="image/png" href="favicon-125x125.png"/>
    <!--<link rel="icon" href="favicon.ico">-->

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Georeferencing videos</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Leaflet -->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
    <!-- IntroJS -->
    <link rel="stylesheet" href="introjs/introjs.css" />
    <!-- Custom CSS -->
    <link href="index.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    </div>

    <?php
    /*
      //$ffmpeg_path = '/usr/bin/ffmpeg'; //or: ffmpeg - depends on your installation
      $vid = 'videos/muenster-promenade.mp4';
      //$command = $ffmpeg . ' -i ' . $video . ' -vstats 2>&1';  
      $output=shell_exec("ffprobe -i ".$vid." -show_format -v quiet | sed -n 's/duration=//p' 2>&1");
      echo($output);
    */
    ?>

    <div class="row">
      <div class="col-md-8" id="map" 
        data-intro='This is the <b>map box</b>, you can <b>pan</b> it and <b>zoom</b> it wherever you want. <br></br> You can also place video
                     <span class="text-info"><b>waypoint</b></span> by <b>clicking</b> on the map and then <b>click again</b> to setting the
                     <span class="text-warning"><b>field of view</b></span> of the video in that <span class="text-info"><b>waypoint</b></span>.
                     <br></br> If you have place a <span class="text-info"><b>waypoint</b></span> wrongly you can <b>drag and drop</b> it to
                     another position or just <b>click on it</b> to see its details and <b>delete</b> it.' 
        data-position='right'
        data-step="6">
      </div>
      <div class="col-md-4" id="section">
        <!--
        <br>  Participant number <input id="participant" type="number"> <br> </br> -->
        <div class="alignleft">
          <b>Routing options:</b> </br>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-primary active"> 
              <input type="radio" name="options" onchange="changevehicle(this)" value="foot" checked> Walk
            </label>
            <label class="btn btn-primary">
              <input type="radio" name="options" onchange="changevehicle(this)" value="bike"> Bike
            </label>
            <!--
            <label class="btn btn-primary">
              <input type="radio" name="options" onchange="changevehicle(this)" value="car"> Car
            </label> -->
          </div>
        </div>
        <div class="alignright" data-intro='When you finish, you have to <b>save the geotag</b> pressing the <span class="text-success">
        <b>green save button</b></span>. You can also replay this tutorial by clicking the <span class="text-primary"><b>light blue info button</b></span>.' 
              data-step="7">
          <b> Save: &nbsp; Info:</b> </br>
          <button id="save-button" type="submit" class="btn btn-success" onclick="save()">
            <span id="save-icon" class="glyphicon glyphicon-save" aria-hidden="true"></span>
          </button> 
          <button id="save-button" type="submit" class="btn btn-info" onclick="introJs().start()">
            <span id="save-icon" class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
          </button>
        </div>
        <div style="clear: both;"></div>
        <p></p>
        <form  method="post" role="form" action="action.cgi" enctype="multipart/form-data" id="submit" style="margin-right:10pt;">
          <b>Submit new video:</b>
          <input type="file" name="nombre" class="form-control" disabled>
        </form> <p></p>
        <form id="select" style="margin-right:10pt;"
              data-intro='<b>Welcome to the GeoRef Videos WebApp! </b><br></br>
                          This is the <b>video selector</b>, you can try selecting the video called <b>Route2</b>' 
              data-step="1">
          <b>Select existing video:</b> 
          <select name="videos" class="form-control">
            <option value="" selected="true"> --- </option>
            <option value="route2_20151111_150618.mp4">Route2: Fachhoschule, Correnstraße - Heisenbergstraße Münster</option>
          </select>
        </form><p></p>
        <div align="center" class="embed-responsive embed-responsive-16by9" style="margin-right:10pt;"
            data-intro='Now the tutorial1 video has been loaded! Try to click on it to <b>play/pause</b> it.' 
            data-step="2">
            <video class="embed-responsive-item" id="video1" muted>
              <!--<source src="videos/muenster-promenade.mp4" type="video/mp4">-->
              <track src="videos/thumbs.vtt" kind="metadata" default>
              <track src="videos/captures.vtt" kind="metadata" default>
              A browser with <a href="http://www.jwplayer.com/html5/">HTML5 text track support</a> is required.
            </video>
        </div>
        <p></p>
        <div data-intro='You can <b>control</b> the video using the <b>buttons</b> or the <b>keyboard</b> <br>
                          <ul> <li>Play/Pause: Space</li> <li>Rewind: del</li> 
                               <li>Change Speed: 1, 2, 3, 4, 5 keys </li> 
                               <li>Step-foward: right arrow</li> <li>Step-backward: left arrow</li> 
                               <li>Fullscreen: F12</li> </ul>' 
              data-step="3">
          <button type="button" class="btn btn-default" id="rewind" onclick="fullScreen()">
            <span class="glyphicon glyphicon-resize-full" aria-hidden="true"></span>
          </button>
          <button type="button" class="btn btn-default" id="playPause" onclick="playPause()">
            <span class="glyphicon glyphicon-play" aria-hidden="true"></span> / 
            <span class="glyphicon glyphicon-pause" aria-hidden="true"></span>
          </button>
          <button type="button" class="btn btn-default" id="rewind" onclick="rewind()">
            <span class="glyphicon glyphicon-step-backward" aria-hidden="true"></span>
          </button>
          <div class="btn-group" data-toggle="buttons">
              <label class="btn btn-default active">
                <input type="radio" id="speed1" name="options" onchange="speed(this);" value="1"> 1x
              </label>
              <label class="btn btn-default">
                <input type="radio" id="speed2" name="options" onchange="speed(this);" value="2"> 2x
              </label>
              <label class="btn btn-default">
                <input type="radio" id="speed3" name="options" onchange="speed(this);" value="3"> 3x
              </label>
              <label class="btn btn-default">
                <input type="radio" id="speed4" name="options" onchange="speed(this);" value="4"> 4x
              </label>
              <label class="btn btn-default">
                <input type="radio" id="speed5" name="options" onchange="speed(this);" value="5"> 5x
              </label>
          </div>
          <!-- <p style="display: inline" id="clock">t = 0</p> -->
          <button id="clock" class="btn btn-default" disabled>00:00</button>
        </div>
        <!--<form >
          <input type="checkbox" id="showcaptionscheck" onclick="check(this)"> Show/Hide extraction status<br>
        </form>-->
        <div data-intro="In the <b>sugested places</b> area you can find places wich may correspond to the video location. 
                         Why don't you try to click in the <b>Münster</b> suggestion?" data-step="5"
          </br><b>Sugested places:</b>
          <ul id="sugestedPlaces" style="list-style-type:none">
          </ul>
        </div>
      </div>
    </div> 

    <div id="timeline" data-intro='You can even control the video by using this <span class="text-danger"><b>timeline</b></span>.
                                   Try it!' data-step="4" data-position='top'></div>
    <span id="thumb"></span>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content panel-warning" >
          <div class="modal-header panel-heading">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Warning!</h4>
          </div>
          <div class="modal-body">
            <p>It looks like you have done some progress. If you change the video that progress will be deleted. Are you sure do you want to continue?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="callback(false)">No</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="callback(true)">Yes</button> 
          </div>
        </div>

      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/victor.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" 
            crossorigin="anonymous"></script>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script type="text/javascript" src="introjs/intro.js"></script>
    <script type="text/javascript" src="waypoint.js"></script>
    <script type="text/javascript" src="keyboard.js"></script>
    <script type="text/javascript" src="parseKML.js"></script>
    <script type="text/javascript" src="index.js"></script>
  </body>
</html>
