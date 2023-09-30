<?php 
include 'lib/Gawain.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
<link rel="manifest" href="site.webmanifest">
<base href="<?php echo $App->baseName();?>" /> 
<title><?php echo $App->title(); ?></title>
<link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.min.css">
<meta name="description" content="<?php echo $App->meta(); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Finlandica&family=Josefin+Sans&family=Marcellus&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="bundles/bs46/css/bootstrap.min.css">
<?php $App->renderBundles(); ?>
</head>
<body>
<?php 
$App->renderTemplate();
$App->renderBundlesLast(); 
?>
<script src="bundles/jquery-3.7.0.slim.min.js"></script>
<script src="bundles/bs46/js/bootstrap.min.js"></script>
</body>
</html>

