<?php
require __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../sag/Sag.php';

function on_before($params)
{
  $sag = new Sag('bigbluehat.ic.tl', '5984');
  $sag->setDatabase('phlattr');
  $params['sag'] = $sag;

  if (empty($_SESSION['flattr_username']))
  {
    flash('You are not authenticated, please connect with flattr.','alert');
    redirect('/');
  }
  $params['client'] = new OAuth2Client(ConfigFlattr::all(array('access_token' => $_SESSION['access_token'])));
  return $params;
}

function on_get($params)
{
  $sag = $params['sag'];

  $vars = array(
    'profile' => $params['client']->getParsed('/user'),
    'things'  => $params['client']->getParsed('/user/things'),
    'title'   => 'signed in!',
  );

  try {
  // get list of existing registered phones and display them
    print_r($sag->get($_SESSION['flattr_username']));
  } catch(SagCouchException $e) {
    // The requested post doesn't exist - oh no!
    if($e->getCode() == "404") {
      $e = new Exception("That post doesn't exist.");
    }
    throw $e;
  }
  // if it 404's, create it so we'll have it later
  return template(basename(__FILE__),$vars);
}

function on_post($params) {
  // get the list of phones
  // add the new submitted phone to the list
  // load the GET resource
  $json = array('user' => $_SESSION['flattr_username'],
                'phones' => array());
}
run(basename(__FILE__),'.php');
