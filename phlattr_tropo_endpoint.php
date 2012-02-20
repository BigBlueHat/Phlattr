<?php
/**
 * @param $u Flatter username
 * @param $p Phone registered for the above user
 */

// Log the incoming params
// ?u=BigBlueHat
_log('Flattr User: ' . $u);
// &p=11231231234
_log('Phone: ' . $p);

// Setup the Couch connection
$couch = new CouchSimple(array('host' => 'bigbluehat.ic.tl', 'port' => 5984));

$couch->user = 'REPLACE ME';
$couch->pass = 'REPLACE ME';

// if the user is TXTing us first
if ($currentCall->initialText) {
  // let's log what they sent and from where
  _log("*** User sent: " . $currentCall->initialText . " ***");
  _log("*** CallerID: " . $currentCall->callerID . " ***");

  // this empty ask() will catch that text, and fill the $result.
  $result = ask("", array("choices" => "[ANY]"));

  $number = preg_replace('/[A-Za-z\s\W]+/', '', $result->value);
  // international numbers are capped at 15 digits total (including country code)
  if (strlen($number) > 15) {
    ask('Sorry, it looks like that number was too long. Be sure the phone
        number is the only number in your text.', array('choices' => '[ANY]'));
  } else {
    // looks like we've got a phone number, so look it up!
    function getPhlattrUser($number) {
      // using ?key= on this view should only return a single entry
      $view_results = $couch->send('GET', '/phlattr/_design/phlattr/_view/phones_by_number?key="' . $number . '"');

      // if the phone exists in Phlattr,
      if (count($view_results['rows']) > 0) {
        // return the doc_id / Flattr user ID
        return $view_results['rows'][0]['id'];
      } else {
        return false;
      }
    }

    // if both phones exist
    if ($caller = getPhlattrUser($currentCall->callerID) && $recipient = getPhlattrUser($number)) {
      // then lets create a "ledger" entry for this phlattr
      $phlattr = array('user' => array('id' => $caller, 'number' => $currentCall->callerID),
                       'wants_to_phlattr' => array('id' => $recipient, 'number' => $number),
                       'requested' => time(),
                       'unconfirmed' => null);
      $couch->send('POST', '/phlattr/', json_encode($phlattr));
      // and trigger processing of pending phlattry
      _log('process HTTP response: ' . file_get_contents('http://phlattr.bigbluehat.com/process.php'));
    }
  }
} else {
  // if they're not texting us first, then we're sending them the a confirmation request.
  // so, first we get the doc for the requested phone
  $doc = $couch->send('GET', '/phlattr/' . $u);

  // if the doc is found,
  if ($doc !== null) {
    // then we send the 'ask' stuff to the unconfirmed phone for that user
    if (array_key_exists($p, $doc['phones']) && !$doc['phones'][$p]['confirmed']) {
      call('+' . $p, array("timeout" => 60, "channel" => "TEXT", "network" => "SMS"));
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