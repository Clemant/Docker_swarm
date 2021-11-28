#!bin/sh
echo -e '<?php \n $dbhost ="'$HOST'"; \n $dbuser ="'$USER'"; \n $dbpass ="'$PASSWORD'"; \n $dbname ="'$DATABASE'";\n?>' > conf.php

sleep 10
php createbase.php
php server.php

