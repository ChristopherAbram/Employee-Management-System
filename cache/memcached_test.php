<?php

/* Create a regular instance */
$m = new Memcache();
echo get_class($m);

/* Create a persistent instance */
$m2 = new Memcache('story_pool');
$m3 = new Memcache('story_pool');

/* now $m2 and $m3 share the same connection */

echo '<pre>';
var_dump($m2);
echo '</pre>';
