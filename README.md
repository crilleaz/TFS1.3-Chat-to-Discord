# TFS1.3-Chat-to-Discord
Transfer chats via game to Discord

### Installation

1. Clone the repository
```
git clone https://github.com/crilleaz/TFS1.3-Chat-to-Discord/
```

2. Setup
```
Move content of chatchannels/scripts into your TFS1.3-server, replace existing ones
Import chats.sql into your database

Add cronjob for the webhook:
$sudo crontab -e
* * * * * php -e /path/to/dc_offload_chats.php
```
