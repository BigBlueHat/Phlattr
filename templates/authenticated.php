<section class="row">
  <div class="span10">
  <h2><?= h($p['profile']['username']);?>'s Phones:</h2>
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

  <div class="span12">
   <h2>Once you've confirmed your phone above...</h2>
   <p>The next step is to TXT another Flattr users phone number to the number you received the confirmation TXT from.</p>
   <p>After doing that, we'll display how things are going below.</p>
  </div>

  <div class="span12">
    <h2>Flattrs so far...</h2>
    <?php if (count($p['phlattry']) == 0): ?>
    <p>No Flattrs sent yet. We'll show you how things are going here, once you've sent some texts.</p>
    <?php else: ?>
    <p>Flattrs done or en route initiated via Phlattr:</p>
    <ul>
    <?php foreach($p['phlattry'] as $phlattry): ?>
      <li<?php echo $phlattry->value->confirmed == null ? ' class="unconfirmed"' : ''; ?>>
        <?= h($phlattry->value->user->id); ?> via <?= h($phlattry->value->user->number); ?>
        <strong>flattred</strong>
        <?= h($phlattry->value->wants_to_phlattr->id); ?> at <?= h($phlattry->value->wants_to_phlattr->number); ?> <?php echo $phlattry->value->confirmed == null ? ' (in progress)' : ''; ?>
      </li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
</section>
