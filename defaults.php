<?php
// A simple helper script that will setup initial module
// settings in case one of these settings is missing.

if (!defined('PHORUM') && !defined('PHORUM_ADMIN')) return;

// The settings array itself.
if (!isset($GLOBALS['PHORUM']['mod_readable_dates'])) {
    $GLOBALS['PHORUM']['mod_readable_dates'] = array();
}

$mod_readable_dates_defaults = array(
    'buddies'             => 1,
    'conceal_times'       => 0,
    'granularity'         => 60,
    'index'               => 1,
    'list'                => 1,
    'max_time'            => '',
    'mod_announcements'   => 1,
    'pm_list'             => 1,
    'pm_read'             => 0,
    'profile'             => 1,
    'read'                => 0,
    'read_userregdate'    => 0,
    'readable_numbers'    => 1,
);

// The default options.
foreach ($mod_readable_dates_defaults as $page => $default) {
    if (!isset($GLOBALS['PHORUM']['mod_readable_dates'][$page])) {
        $GLOBALS['PHORUM']['mod_readable_dates'][$page] = $default;
    }
}
?>
