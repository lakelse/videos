<?php
error_reporting(E_ALL & ~E_NOTICE);

$mailbox = "{127.0.0.1:1993}INBOX";
$user = getenv("IMAP_USERNAME");
$password = getenv("IMAP_PASSWORD");

echo "Trying to connect as: $user <br />\n<br />\n";

$mbox = imap_open($mailbox, $user, $password);

if (!$mbox) {
  echo "<pre>";
  print_r(imap_errors());
  echo "</pre>";
  exit;
}

$MC = imap_check($mbox);

// Fetch an overview for all messages in INBOX
$result = imap_fetch_overview($mbox,"1:{$MC->Nmsgs}",0);
echo "<table>";
foreach ($result as $overview) {
    echo "<tr><td>#{$overview->msgno}</td><td>({$overview->date})</td><td>{$overview->from}</td>
    <td>{$overview->subject}</td></tr>\n";
}
echo "</table>";
imap_close($mbox);