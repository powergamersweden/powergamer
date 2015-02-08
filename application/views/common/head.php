
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui=1">
	<title><?php echo $title ?></title>

	<script type="text/javascript" src="https://www.youtube.com/player_api"></script>

	<link href="<?php echo $assets ?>/styles/main.css?v=5" media="all" rel="stylesheet" type="text/css" />
	<script>
		var api = "<?php echo $api ?>";
		var quality = "<?php echo $quality ?>";
	</script>
	<script type="text/javascript" src="<?php echo $assets ?>/scripts/components.min.js?v=5"></script>
	<script type="text/javascript" src="<?php echo $assets ?>/scripts/main.min.js?v=5"></script>
</head>
<body class="<?php echo $bodyClass ?>">