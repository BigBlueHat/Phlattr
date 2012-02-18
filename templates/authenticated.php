<section class="row">
  <div class="span10">
  <h3><?= h($p['profile']['username']);?>'s Phones:</h3>
  <?php if (count($p['phones']) == 0): ?>
  <p>You've not connected a phone number to your Flattr account yet. Want to now?</p>
  <?php else: ?>
  <p>You've connected these phone numbers:</p>
  <ul>
  <?php foreach($p['phones'] as $phone => $info): ?>
    <li<?php echo $info->confirmed == false ? ' class="unconfirmed"' : ''; ?>>
      <?= h($phone); ?><?php echo $info->confirmed == false ? ' (pending confirmation)' : ''; ?>
    </li>
  <?php endforeach; ?>
  </ul>
  <?php endif; ?>
  </div>
  <div class="span2" style="text-align:right">
  <a href="/logout.php" class="btn">
    <i class="icon-off"></i>
    Logout
  </a>
  </div>
  <div class="span12">
  <form method="post" class="form-inline">
    <fieldset class="well">
      <header><h3>Connect a new phone number:</h3></header>
      <input name="phone" placeholder="your phone number">
      <button type="submit" class="btn">Connect</button>
      <div class="help-inline">Be sure to include your country code when submitting your phone number!</div>
    </fieldset>
  </form>
  </div>
</section>
