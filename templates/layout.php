<!DOCTYPE html>
<html>
  <head>
    <title><?=h($p['title'])?></title>
    <link type="text/css" rel="stylesheet" href="/style.css"/>
  </head>
  <body>
    <h1><?=h($p['title'])?></h1>
    <hr/>
    <?=flasher()?>
    <?=$p['_content']?>
    <hr/>
    <footer><a href="https://github.com/BigBlueHat/Phlattr">Fork Phlattr</a></footer>
  </body>
</html>
