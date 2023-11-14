<?php 
include 'lib/Gawain.php';
?>
<!doctype html>
<html lang="da" translate="no">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="site.webmanifest">
<base href="<?php echo $App->baseName();?>"> 
<title><?php echo $App->title(); ?></title>
<meta name="description" content="<?php echo $App->meta(); ?>">
<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="bundles/bs46/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="bundles/magnific/magnific-popup.css">
<meta name="google-site-verification" content="1ZC5iqvCMH0mX_7saG6it6ySFXjfzwNEFHA2yzlf4Q8">
<?php $App->renderBundles(); ?>
</head>
<body>
<?php 
$App->renderTemplate();
$App->renderBundlesLast(); 
?>
<script src="bundles/jquery-3.7.0.slim.min.js"></script>
<script src="bundles/bs46/js/bootstrap.min.js"></script>
<script src="bundles/magnific/jquery.magnific-popup.min.js"></script>
<script src="bundles/pwdk.js"></script>
</body>
</html>

