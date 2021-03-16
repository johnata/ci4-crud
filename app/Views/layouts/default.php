<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection("title"); ?></title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap.min.css"); ?>">
    
    <!-- AdditionalCSS -->
    <?= $this->renderSection("AdditionalCSS"); ?>
    
    <!-- jQuery Library -->
    <script src="<?= base_url("assets/js/jquery-3.6.0.min.js"); ?>"></script>
</head>
<body>
    <?= $this->renderSection("content"); ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?= base_url("assets/js/bootstrap.bundle.min.js"); ?>"></script>
  
    <!-- AdditionalJS -->
    <?= $this->renderSection("AdditionalJS"); ?>
</body>
</html>