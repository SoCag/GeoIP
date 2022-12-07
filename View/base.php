<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Information IP</title>
  <link rel="icon" type="image/x-icon" href="<?php echo $dataArray['style'].'Assets/Image/favicon.ico'; ?>">
  <link rel="stylesheet" href="<?php echo $dataArray['style'].'Assets/Style/style.scss'; ?>">
</head>
<body>
  
  <!-- DIV ERREURS -->
  <?php
    if($dataArray['error'] != '' && $dataArray['error'] != null)
    {
  ?>
  <div class="error">
    <?php echo $dataArray['error']; ?>
  </div>
  <?php
    }
  ?>

  <!-- DIV WARNING -->
  <?php
    if($dataArray['warning'] != '' && $dataArray['warning'] != null)
    {
  ?>
  <div class="warning">
    <?php echo $dataArray['warning']; ?>
  </div>
  <?php
    }
  ?>
  
  <!-- DIV MESSAGES -->
  <?php
    if($dataArray['message'] != '' && $dataArray['message'] != null)
    {
  ?>
  <div class="message">
    <?php echo $dataArray['message']; ?>
  </div>
  <?php
    }
  ?>

  <?php require($body); ?>
  
</body>
</html>