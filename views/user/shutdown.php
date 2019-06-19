<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ACCOUNT SUSPENDED</title>
  </head>
  <body style="text-align: center">
    <h1><span style="color:gray">ACCOUNT</span> SUSPENDED</h1>
    <p>Please contact your administrator or provider.</p>
    <?php if( SHUTDOWN_MSG && !empty(SHUTDOWN_MSG) ): ?>
    <p>" <i><?= SHUTDOWN_MSG ?></i> "</p>
    <?php endif ?>
  </body>
</html>
