<?php
/**
 * @param $u Flatter username
 * @param $p Phone registered for the above user
 */

_log('Flattr User: ' . $u);
_log('Phone: ' . $p);

$couch = new CouchSimple(array('host' => 'bigbluehat.ic.tl', 'port' => 5984));

// on incoming request to this script...
// get the doc for the requested phone
$doc = $couch->send('GET', '/phlattr/' . $u);

// if the doc is found
if ($doc !== null) {
  // send the 'ask' stuff to the unconfirmed phone for that user
  if (array_key_exists($p, $doc['phones']) && !$doc['phones'][$p]['confirmed']) {
    call('+' . $p, array('network' => 'SMS'));
    $result = ask("Are you sure you want this phone connected to the '{$u}' Flattr account (yes or no)?",
                  array('choices' => 'Yes, yes, yea, No, no'));

    _log('responded with: ' . $result->value);

    // if the response is positive
    if (strtolower($result->value) === 'yes' || strtolower($result->value) === 'yea') {
      // mark that number as confirmed by adding a timestamp as the confirmed value
      $doc['phones'][$p]['confirmed'] = time();
      $put_results = $couch->send('PUT', '/phlattr/' . $u, json_encode($doc));
      _log('PUT results: ' . $put_results);
    } else {
      // otherwise, remove the number from the list of phones completely?

    }

  }
}

class CouchSimple {
  function CouchSimple($options) {
    foreach($options AS $key => $value) {
      $this->$key = $value;
    }
  } 

  function send($method, $url, $post_data = NULL) {
    $s = fsockopen($this->host, $this->port, $errno, $errstr);
    if(!$s) {
      echo "$errno: $errstr\n";
      return false;
    }

    $request = "$method $url HTTP/1.0\r\nHost: $this->host\r\nContent-Type: application/json\r\n";

    if ($this->user) {
      $request .= "Authorization: Basic ".base64_encode("$this->user:$this->pass")."\r\n";
    }

    if($post_data) {
      $request .= "Content-Length: ".strlen($post_data)."\r\n\r\n";
      $request .= "$post_data\r\n";
    } else {
      $request .= "\r\n";
    }

    fwrite($s, $request);
    $response = "";

    while(!feof($s)) {
      $response .= fgets($s);
    }

    list($this->headers, $this->body) = explode("\r\n\r\n", $response);
    return json_decode($this->body, true);
  }
}
?>