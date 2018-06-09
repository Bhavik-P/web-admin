<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>True Translator</title>

  <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/plugins/toggles/toggles.css" rel="stylesheet">

  <script src="assets/js/modernizr.min.js"></script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>
<?php
   require_once("../config.php");
	$reset=$_REQUEST['reset'];
	$hash=$_REQUEST['hash'];
	$id=base64_decode($hash);
?>
<body class="fixed-left widescreen">
<div class="wrapper-page">
  <div class="panel panel-color panel-primary panel-pages">
    <div class="panel-heading bg-img">
      <div class="bg-overlay"></div>
      <h3 class="text-center m-t-10 text-white">Reset Password</h3></div>
    <div class="panel-body">
      <form class="form-horizontal m-t-20" action="admin_code/reset_pass.php" method="POST">
        <div class="form-group">
          <div class="col-lg-12 col-xs-12">
            <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></i></span>
              <input type="hidden" id="username" name="id" class="form-control" value="<?php echo $id; ?>">
              <input type="Password" id="username" name="pass" class="form-control" placeholder="Enter New Password">
            </div>
          </div>
        </div>
		<div class="form-group">
          <div class="col-lg-12 col-xs-12">
            <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></i></span>
              <input type="Password" id="username" name="con_pass" class="form-control" placeholder="Enter Confirm Password">
            </div>
          </div>
        </div>
        <div class="form-group text-center m-t-40">
          <div class="col-xs-12">
            <button class="btn btn-block btn-lg btn-primary waves-effect waves-light" type="submit" name="reset">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Main  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/jquery.nicescroll.min.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/hope.js"></script>
<script src="assets/js/jquery.check-toggle.js"></script>
<script src="assets/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script src="assets/plugins/toggles/toggles.min.js"></script>
</body>

</html>