<?php

$mailbox = "{127.0.0.1:1993}INBOX";
$user = getenv("IMAP_USERNAME");
$password = getenv("IMAP_PASSWORD");

echo "Trying to connect as: $user <br /><br />";

$mbox = imap_open($mailbox, $user, $password);

if ($mbox) {
  echo "It worked!";
}
else {
  echo "It didn't work!";
  print_r(imap_errors());
}

