this is an authenticated page.

<div>
  you are connected as <strong><?= h($p['profile']['username']);?></strong>
</div>
<div>
  <p>
    your things:
  </p>
  <?php foreach($p['things'] as $thing) { ?>
    <?=h($thing['url']);?></br>
  <?php } ?>
</div>

<div>
  <h3>Phones:</h3>
  <?php if (count($p['phones']) == 0): ?>
  <p>You've not connected a phone number to your Flattr account yet. Want to now?</p>
  <?php else: ?>
  <p>You've connected these phone numbers:</p>
  <ul>
  <?php foreach($p['phones'] as $phone): ?>
    <li><?= h($phone); ?></li>
  <?php endforeach; ?>
  </ul>
  <?php endif; ?>
</div>

<a href="/logout.php">logout</a>
