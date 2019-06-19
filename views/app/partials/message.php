<?php if( $message = Session::get('message') ): ?>
	
  <div id="message" class="<?= $message['class'] ?>">
    <span class="<?= $message['icon'] ?> margin-right"></span> <?= $message['text'] ?>
  </div>
  
<?php endif; Session::remove('message') ?>
