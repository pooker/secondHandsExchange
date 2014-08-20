<!doctype html>
<html>
<head>
<meta charset="utf-8" />
</head>
<body>
<?php echo $pagination; ?>

<?php if (isset($accounts)): foreach ($accounts as $key => $a): ?>
<p><?php echo $a->description;?></p>
	<?php endforeach; endif; ?>

</body>