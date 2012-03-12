<?php
  require 'fb-php-sdk/facebook.php';

  // TODO: Replace these values with the app's values.
  $app_id = 'APP_ID';
  $app_secret = 'APP_SECRET';
  $app_namespace = 'criticalmasspay';
  $app_url = 'http://apps.facebook.com/' . $app_namespace . '/';
  $scope = 'email,publish_actions';

  // Init the Facebook SDK
  $facebook = new Facebook(array(
    'appId'  => $app_id,
    'secret' => $app_secret,
  ));

  // Get the current user
  $user = $facebook->getUser();

  // If the user has not installed the app, redirect them to the Auth Dialog
  if (!$user) {
    $loginUrl = $facebook->getLoginUrl(array(
      'scope' => $scope,
      'redirect_uri' => $app_url,
    ));
    
    print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
  }

// Delete multiple Requests on Accept
  if(isset($_REQUEST['request_ids'])) {
      $requestIDs = explode(',' , $_REQUEST['request_ids']);
      foreach($requestIDs as $requestID) {
        try {
          $delete_success = $facebook->api('/' . $requestID, 'DELETE');
        } catch(FacebookAPIException $e) {
          error_log($e);
        }
      }
    }

?>

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
<div id="fb-ui-return-data"></div>
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
  var appId = '<?php echo $facebook->getAppID() ?>';
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
</script>

</body>
</html>