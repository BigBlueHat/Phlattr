<?php
require __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../sag/Sag.php';

function on_before($params)
{
  $sag = new Sag('bigbluehat.ic.tl', '5984');
  $sag->login(require_once __DIR__ . '/../.couch_login.php', require_once __DIR__ . '/../.couch_pass.php');
  $sag->setDatabase('phlattr');
  $params['sag'] = $sag;

  /* TODO: we still need OAuth to post...but what does that look like exactly?
  if (empty($_SESSION['flattr_username']))
  {
    flash('You are not authenticated, please connect with Flattr.','alert');
    redirect('/');
  }
  $params['client'] = new OAuth2Client(ConfigFlattr::all(array('access_token' => $_SESSION['access_token'])));
  */
  return $params;
}

function on_get($params)
{
  $sag = $params['sag'];

  // GET unconfirmed phlattrs
  $unconfirmed_phlattrs = $sag->get('_design/phlattr/_view/phlattry?key=["confirmed",null]&include_docs=true')->body;

  if (count($unconfirmed_phlattrs->rows) > 0) {
    foreach ($unconfirmed_phlattrs->rows as $row) {
      // setup and send the actual Flattr request
      flattr($row, $sag);
    }
  }
}


function flattr($row, $sag) {
  $phlattry_doc_id = $row->id;
  $phlattry_doc = $row->value;
  $phlattry_user = $row->doc;

  $client = new OAuth2Client(ConfigFlattr::all(array('access_token' => $phlattry_user->access_token)));
  $thing = $client->getParsed('/things/lookup/?url=' . urlencode('http://flattr.com/profile/'. $phlattry_doc->wants_to_phlattr->id));
  $thing_id = isset($thing['id']) ? $thing['id'] : substr(strrchr($thing['location'], '/'), 1);
  header('Content-Type: text/plain');
  $flattrd = $client->post('/things/' . $thing_id . '/flattr', array());
  // store this in a log section on the phlattry doc
  $sag->put('_design/phlattr/_update/log/' . $phlattry_doc_id, $flattrd);
  // if it was a success, then also update the 'confirmed' key w/current time
  if ($flattrd->responseCode == 200) {
    $sag->put('_design/phlattr/_update/confirm/' . $phlattry_doc_id, array());
  }
  // TODO: let originating user know via a TXT that it all worked! :D
}

run(basename(__FILE__),'.php');
