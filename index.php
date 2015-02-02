<?php include "controller.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
  <title>Black jack</title>
</head>
<body>
<div class="container">
  <div class="row">
    <h3>Bank</h3>
    <?php var_dump($bj->bank->showHand());?>
  </div>
  <div class="row">
    <h3>Player</h3>
    <?php var_dump($bj->player->showHand()); ?>
  </div>
  <div class="row">
    <?php var_dump($view);?>
    <form method="POST" action=".">
      <button type="submit" name="HIT" class="btn btn-success">HIT</button>
      <button type="submit" name="PASS" class="btn btn-warning">PASS</button>
      <button type="submit" name="RESET" class="btn btn-danger">RESET</button>
    </form>
  </div>

</div>


</body>
</html>



