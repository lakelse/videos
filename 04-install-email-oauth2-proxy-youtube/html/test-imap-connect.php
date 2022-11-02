<?php

$mailbox = "{host.docker.internal:1993}INBOX"
$user = "jon@letstestoauth2.onmicrosoft.com";
$password = "password-here"

$mbox = imap_open($mailbox, $user, $password);

if ($mbox) {
  echo "It worked!";
}
else {
  echo "It didn't work.";
  print_r(imap_errors());
}

