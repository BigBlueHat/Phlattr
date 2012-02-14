<header>
  <h2>
    Welcome <strong><?= h($p['profile']['username']);?></strong>
  </h2>
</header>
<section style="border-top:1px solid #aaa">
  <h3>
    Your Things:
  </h3>
  <ul>
  <?php foreach($p['things'] as $thing) { ?>
    <li><?=h($thing['url']);?></li>
  <?php } ?>
  </ul>
</section>

<section style="border-top:1px solid #aaa;margin-top:15px">
  <h3>Phones connected to your Flattr account:</h3>
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
  <form method="post" class="form-inline">
    <header>Connect a phone number with your <strong><?= h($p['profile']['username']);?></strong> Flattr account</header>
    <input name="phone" />
    <button type="submit">Connect</button>
    <div>Be sure to include your country code when submitting your phone number!</div>
  </form>
</section>

<a href="/logout.php">logout</a>
