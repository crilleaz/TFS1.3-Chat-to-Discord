<?php
// Set up database connection
$db_host = "localhost";
$db_user = "";
$db_pass = "";
$db_name = "";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Set up Discord webhook URL
$webhook_url = "https://discord.com/api/webhooks/";

// Get current time and time 30 seconds ago
$current_time = date("Y-m-d H:i:s");
$old_time = date("Y-m-d H:i:s", strtotime("-60 seconds"));

// Fetch new messages from database
$query = "SELECT * FROM chats WHERE chat_time >= '$old_time' AND chat_time <= '$current_time'";
$result = mysqli_query($conn, $query);

// Create Discord message content
$content = "";
while ($row = mysqli_fetch_assoc($result)) {
  $chat_time_unix = strtotime($row['chat_time']); // Convert chat_time string to Unix timestamp
  if ($row['chat_channel'] == "Worldchat") {
    $content .= "[Worldchat]: " . date('H:i:s', $chat_time_unix) . ", " . $row['from_player'] . ": " . $row['chat_message'] . "\n";
  } elseif ($row['chat_channel'] == "Help") {
    $content .= "[Help]: " . date('H:i:s', $chat_time_unix) . ", " . $row['from_player'] . ": " . $row['chat_message'] . "\n";
  } elseif ($row['chat_channel'] == "Englishchat") {
    $content .= "[Englishchat]: " . date('H:i:s', $chat_time_unix) . ", " . $row['from_player'] . ": " . $row['chat_message'] . "\n";
  } elseif ($row['chat_channel'] == "Trade") {
    $content .= "[Trade]: " . date('H:i:s', $chat_time_unix) . ", " . $row['from_player'] . ": " . $row['chat_message'] . "\n";
  } else {
    $content .= $row['chat_message'] . "\n";
  }
}


// Send message to Discord webhook if there are new messages
if (!empty($content)) {
  $data = array("content" => $content);
  $options = array(
    "http" => array(
      "header"  => "Content-type: application/json",
      "method"  => "POST",
      "content" => json_encode($data)
    )
  );
  $context  = stream_context_create($options);
  $result = file_get_contents($webhook_url, false, $context);
} else {
  echo "There are no new chats at the moment.";
}

// Close database connection
mysqli_close($conn);

?>
