<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= $description ?>">
    <link rel="stylesheet" href="css/style.css" />
    <title>TomTroc • <?= $title ?></title>
  </head>
  <body>
    <?php require "src/views/layout/navigation.php" ?>

    <main class="<?= $mainClass ?>">
      <?= $content ?>
    </main>

    <?php require "src/views/layout/footer.php" ?>
  </body>
</html>
