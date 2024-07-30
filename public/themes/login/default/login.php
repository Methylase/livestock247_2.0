<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <title>Livestock247 - <?php echo $title ?></title>
    <link rel="icon" href="<?= THEME_DIR?>img/logo.png" type="image/icon type">
    <link rel="stylesheet" href="<?= BASE_URL?>bootstrap-4/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= THEME_DIR?>css/style.scss">
    <script src="<?= BASE_URL?>bootstrap-4/js/jquery.js"></script> 
    <script src="<?= BASE_URL?>bootstrap-4/js/bootstrap.min.js"></script> 

  </head>
  <body>
    <?= Template::display($data) ?>
</body>
</html>
