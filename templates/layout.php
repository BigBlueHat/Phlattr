<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Phlattr -=- <?=h($p['title'])?></title>
	<meta name="description" content="Phlattr lets you Flattr Phone numbers!">
	<meta name="author" content="BigBlueHat - http://bigbluehat.com/">

	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="css/bootstrap.css">
	<style>
	body {
	  padding-top: 60px;
	  padding-bottom: 40px;
	}
	</style>
	<link rel="stylesheet" href="css/bootstrap-responsive.css">
	<link rel="stylesheet" href="css/style.css">

	<script src="js/libs/modernizr-2.5.2-respond-1.1.0.min.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
    (function() {
        var s = document.createElement('script'), t = document.getElementsByTagName('script')[0];
        s.type = 'text/javascript';
        s.async = true;
        s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';
        t.parentNode.insertBefore(s, t);
    })();
/* ]]> */</script>
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<!--    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Phlattr</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Add Phones</a></li>
            </ul>
            <ul class="nav">
              <li>
                <a href="/logout.php">
                  <i class="icon-off icon-white"></i>
                  Logout
                </a>
              </li>
            </ul>
          </div>--><!--/.nav-collapse -->
<!--        </div>
      </div>
    </div>
-->

    <div class="container">
      <?=flasher()?>
      <?=$p['_content']?>

      <hr>

      <footer>
        <p>
<a class="FlattrButton" style="display:none;" rev="flattr;button:compact;" href="http://phlattr.bigbluehat.com/"></a>
<noscript><a href="http://flattr.com/thing/508006/Phlattr" target="_blank">
<img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a></noscript>
          <span class="pull-right">
            &copy; BigBlueHat 2012 - Apache License 2.0 - <a href="https://github.com/BigBlueHat/Phlattr">Fork Phlattr on Github</a>
          </span>
        </p>
      </footer>

    </div> <!-- /container -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

<script src="js/libs/bootstrap/transition.js"></script>
<script src="js/libs/bootstrap/collapse.js"></script>

<script src="js/script.js"></script>
<script>
	var _gaq=[['_setAccount','UA-80336-19'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

</body>
</html>
