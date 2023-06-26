# TFS1.3-Chat-to-Discord
Transfer chats via game to Discord<br>
![image](https://github.com/crilleaz/TFS1.3-Chat-to-Discord/assets/20803604/ae83b47c-632e-4f27-a035-8013bd6f1fad)

### Installation

1. Clone the repository
```
git clone https://github.com/crilleaz/TFS1.3-Chat-to-Discord/
```

2. Setup
```
Move content of chatchannels/scripts into your TFS1.3-server, replace existing ones
Import chats.sql into your database
Edit database details and discord webhook in dc_offload_chats.php

Add cronjob for the webhook:
$sudo crontab -e
* * * * * php -e /path/to/dc_offload_chats.php
```

### Discord
Crilleaz
