<!DOCTYPE html>

<html>
<head>
  <title>Critical Mass</title>
  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta property="og:image" content="http://www.mattwkelly.com/html5/critical-mass/critical_mass.png"/>
  
  <link href="client/style.css" rel="stylesheet" type="text/css">
  <link rel="apple-touch-icon" href="http://www.mattwkelly.com/html5/critical-mass/critical_mass.png" />

</head>
<body ontouchmove="BlockMove(event);">
<div id="fb-root"></div>
<script src="//connect.facebook.net/en_US/all.js"></script>

  <div id="stage">  
    <div id="gameboard">
      <canvas id="myCanvas"></canvas>
    </div>
  </div>
  
  <script src="client/core.js"></script>
  <script src="client/game.js"></script>
  <script src="client/ui.js"></script>
  <script src="http://code.jquery.com/jquery-1.5.min.js"></script>

<script>
  var appId = '343598042347842';
  var uid;

  // Initialize the JS SDK
  FB.init({
    appId: appId,
    cookie: true,
  });

  // Get the user's UID and first name
  FB.getLoginStatus(function(response) {
    uid = response.authResponse.userID ? response.authResponse.userID : null;
  });

  function authUser() {
    FB.login(function(response) {
      uid = response.authResponse.userID ? response.authResponse.userID : null;
    }, {scope:'email,publish_actions'});     
  }
</script>

</body>
</html>
