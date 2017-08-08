<?php

require __DIR__.'/../vendor/autoload.php';

use \Firebase\JWT\JWT;

function createSdkUrl() {
    // Change these values to match with your application info.
    $team = 'sample';
    $appNamespace = 'Im2h5WAEmcl2yWrljRkp';
    $appSecret = 'aaKprvCpc1IAE9rUS0fz54iTD47SHC9YQbmXrlkM';
    $sdkUrlAge = 60 * 60 * 6; // 6 hours

    $payload = [
        'exp' => time() + $sdkUrlAge
    ];
    $accessToken = JWT::encode($payload, $appSecret);
    $sdkUrl = "http://{$team}.qoder.byteark.com/apps/{$appNamespace}?access_token={$accessToken}";

    return $sdkUrl;
}
?>

<html>
  
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  </head>

  <body>

    <div class="container mt-5 mb-5">
      <h4>ByteArk Sample Qoder Web SDK</h4>
      <h5 class="mt-5">Upload new video</h5>
      <form>
        <div class="form-group">
          <button type="button" id="uploadButton" class="btn btn-primary" data-sdk-url="<?php echo createSdkUrl(); ?>">Choose Video</button>
        </div>
      </form>
      <h5 class="mt-5">Result</h5>
      <div class="form-group">
        <label for="video_metadata">Video Information</label>
        <textarea class="form-control" id="video_metadata" name="video_metadata" readonly></textarea>
      </div>
    </div>

    <script type="text/javascript" src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="//qoder.byteark.com/sdk/qoder.js"></script>
    <script type="text/javascript">
      qoder.config.url = $('#uploadButton').data('sdk-url');
      
      $('#uploadButton').click(function() {
        qoder.browseVideo(function(video) {
          $('#video_metadata').val(JSON.stringify(video, null, 2));
        });
      });
    </script>

  </body>

</html>