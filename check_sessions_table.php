<?php

try {
    $count = \DB::select('select count(*) as c from sessions');
    echo isset($count[0]) ? $count[0]->c : 'no rows';
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
}
