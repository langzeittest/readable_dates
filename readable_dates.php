<?php

if (!defined('PHORUM')) return;

require_once './mods/readable_dates/defaults.php';
require_once './mods/readable_dates/date_format.php';

function mod_readable_dates_index($data) {
    global $PHORUM;

    // Only format index dates if this is enabled in the configuration.
    if (!$PHORUM['mod_readable_dates']['index']
        && !$PHORUM['mod_readable_dates']['conceal_times']) return $data;

    foreach ($data as $id => $message) {
        // Skip forum folders.
        if ($message['folder_flag']) continue;

        // Format the forum's last post time.
        $message['orig_last_post'] = $message['last_post'];
        if (isset($message['raw_last_post'])) {
            $data[$id]['last_post'] = mod_readable_dates_format_date(
                $message['raw_last_post'], $message['last_post'], $PHORUM['mod_readable_dates']['index']
            );
        }
    }

    return $data;
}

function mod_readable_dates_list($data) {
    global $PHORUM;

    // Only format list dates if this is enabled in the configuration.
    if (!$PHORUM['mod_readable_dates']['list']
        && !$PHORUM['mod_readable_dates']['conceal_times']) return $data;

    foreach ($data as $id => $message) {
        // Format the datestamp.
        $message['orig_datestamp'] = $message['datestamp'];
        $data[$id]['datestamp'] = mod_readable_dates_format_date(
            $message['raw_datestamp'], $message['datestamp'], $PHORUM['mod_readable_dates']['list']
        );

        // Format the last post time. This does not apply to a threaded
        // list view, so we skip this step when needed.
        if (isset($message['raw_lastpost'])) {
            $message['orig_lastpost'] = $message['lastpost'];
            $data[$id]['lastpost']  = mod_readable_dates_format_date(
                $message['raw_lastpost'], $message['lastpost'], $PHORUM['mod_readable_dates']['list']
            );
        }
    }

    return $data;
}

function mod_readable_dates_read($data) {
    global $PHORUM;

    // Only format read dates if this is enabled in the configuration.
    if (!$PHORUM['mod_readable_dates']['read']
        && !$PHORUM['mod_readable_dates']['read_userregdate']
        && !$PHORUM['mod_readable_dates']['conceal_times']) return $data;

    foreach ($data as $id => $message) {
        // Format the user registration date.
        // Phorum itself already does some readable date like stuff on its own,
        // so we have to format orig_date_added ourselves here.
        if (   (    $PHORUM['mod_readable_dates']['read_userregdate']
                 || $PHORUM['mod_readable_dates']['conceal_times'] )
            && !empty($data[$id]['user']['date_added'])) {
            $data[$id]['user']['orig_date_added'] =
                phorum_date(
                    $PHORUM['short_date'],
                    $message['user']['raw_date_added']
                );
            $data[$id]['user']['date_added'] = mod_readable_dates_format_date(
                $message['user']['raw_date_added'],
                phorum_date(
                    $PHORUM['short_date'],
                    $message['user']['raw_date_added'],
                $PHORUM['mod_readable_dates']['read_userregdate']
                )
            );
        }

        // Configuration not enabled for handling further dates on the
        // read pages? Then continue with the next message.
        if (!$PHORUM['mod_readable_dates']['read']
            && !$PHORUM['mod_readable_dates']['conceal_times']) continue;

        // Format the datestamps.
        if (    $PHORUM['mod_readable_dates']['read']
             || $PHORUM['mod_readable_dates']['conceal_times'] ) {
            if (isset($message['raw_datestamp'])) {
                $data[$id]['orig_datestamp'] = $message['datestamp'];
                $data[$id]['datestamp'] = mod_readable_dates_format_date(
                    $message['raw_datestamp'], $message['datestamp'], $PHORUM['mod_readable_dates']['read']
                );
                if (isset($message['short_datestamp'])) {
                    $data[$id]['orig_short_datestamp'] =
                        $message['short_datestamp'];
                    $data[$id]['short_datestamp'] = mod_readable_dates_format_date(
                        $message['raw_datestamp'], $message['short_datestamp'], $PHORUM['mod_readable_dates']['read']
                    );
                }
            }
        }

        // If we have no message body here, we're done.
        if (!isset($message['body'])) continue;

        // Rebuild the message that has been used for the edit count.
        // Since this is a part of the message body itself, we have to
        // take this route to be able to format the date in it :-(
        $max = $PHORUM['mod_readable_dates']['max_time'];
        if (!empty($message['meta']['edit_count'])
            && (empty($max) || (time() - $message['meta']['edit_date']) <= $max)) {
            // Build the string to replace.
            $src = str_replace(
                '%count%',
                $message['meta']['edit_count'],
                $PHORUM['DATA']['LANG']['EditedMessage']
            );
            $src = str_replace(
                '%lastedit%',
                phorum_date(
                    $PHORUM['short_date_time'],
                    $message['meta']['edit_date']
                ),
                $src
            );
            $src = str_replace(
                '%lastuser%',
                $message['meta']['edit_username'],
                $src
            );

            // Build the replacement string.
            $lang = $PHORUM['DATA']['LANG']['mod_readable_dates'];
            $dst = isset($lang['edit_message'])
                 ? $lang['edit_message']
                 : $PHORUM['DATA']['LANG']['EditedMessage'];
            $dst = str_replace(
                '%count%',
                $message['meta']['edit_count'],
                $dst
            );
            $dst = str_replace(
                '%lastuser%',
                $message['meta']['edit_username'],
                $dst
            );
            $dst = str_replace(
                '%lastedit%',
                mod_readable_dates_format_date($message['meta']['edit_date'], NULL, $PHORUM['mod_readable_dates']['read']),
                $dst
            );

            // Replace the edit message and store the result.
            $data[$id]['body'] = str_replace($src, $dst, $message['body']);
        }
    }

    return $data;
}

function mod_readable_dates_profile($data) {
    global $PHORUM;

    // Only format profile dates if this is enabled in the configuration.
    if (!$PHORUM['mod_readable_dates']['profile']
        && !$PHORUM['mod_readable_dates']['conceal_times']) return $data;

    // Format the registered date.
    $data['orig_date_added'] = $data['date_added'];
    $data['date_added'] = mod_readable_dates_format_date(
        $data['raw_date_added'], $data['date_added'], $PHORUM['mod_readable_dates']['profile']
    );

    // These fields might not be set if the user activity is hidden.
    if (isset($data['date_last_active'])) {
        $data['orig_date_last_active'] = $data['date_last_active'];
        // Format the last activity date.
        $data['date_last_active'] = mod_readable_dates_format_date(
            $data['raw_date_last_active'], $data['date_last_active'], $PHORUM['mod_readable_dates']['profile']
        );
    }

    return $data;
}

function mod_readable_dates_pm_read($data) {
    global $PHORUM;

    // Only format pm read dates if this is enabled in the configuration.
    if (!$PHORUM['mod_readable_dates']['pm_read']
        && !$PHORUM['mod_readable_dates']['conceal_times']) return $data;

    // Format the message date.
    $data['orig_date'] = $data['data'];
    $data['date'] = mod_readable_dates_format_date(
        $data['raw_date'], $data['date'], $PHORUM['mod_readable_dates']['pm_read']
    );

    return $data;
}

function mod_readable_dates_pm_list($data) {
    global $PHORUM;

    // Only format list dates if this is enabled in the configuration.
    if (!$PHORUM['mod_readable_dates']['pm_list']
        && !$PHORUM['mod_readable_dates']['conceal_times']) return $data;

    // Format the message dates.
    foreach ($data as $id => $message) {
        $data[$id]['orig_date'] = $data[$id]['date'];
        $data[$id]['date'] = mod_readable_dates_format_date(
            $message['raw_date'], $message['date'], $PHORUM['mod_readable_dates']['pm_list']
        );
    }

    return $data;
}

function mod_readable_dates_buddy_list($data) {
    global $PHORUM;

    // Only format buddy list dates if this is enabled in the configuration.
    if (!$PHORUM['mod_readable_dates']['buddies']
        && !$PHORUM['mod_readable_dates']['conceal_times']) return $data;

    // Format the last active dates.
    foreach ($data as $id => $buddy) {
        $data[$id]['orig_date_last_active'] = $data[$id]['date_last_active'];
        $data[$id]['date_last_active'] = mod_readable_dates_format_date(
            $buddy['raw_date_last_active'], $buddy['date_last_active'], $PHORUM['mod_readable_dates']['buddies']
        );
    }

    return $data;
}

function mod_readable_dates_format($data) {
    global $PHORUM;

    // A bit of trickery to detect from what module this hook was called.
    $bt = debug_backtrace();

    // The announcement module's formatting code.
    if (isset($bt[4]) &&
        $bt[4]['function'] == 'phorum_setup_announcements') {
        // Only format announcements dates if this is enabled in
        // the configuration.
        if (!$PHORUM['mod_readable_dates']['mod_announcements']
            && !$PHORUM['mod_readable_dates']['conceal_times']) {
            return $data;
        }

        foreach ($data as $id => $message) {
            if ($PHORUM['mod_readable_dates']['mod_announcements']) {
                $data[$id]['orig_modifystamp'] = $message['modifystamp'];
                $data[$id]['lastpost'] = mod_readable_dates_format_date(
                    $message['modifystamp'], NULL, $PHORUM['mod_readable_dates']['mod_announcements']
                );
                $data[$id]['orig_datestamp'] = $message['datestamp'];
                $data[$id]['datestamp'] = mod_readable_dates_format_date(
                    $message['raw_datestamp'], NULL, $PHORUM['mod_readable_dates']['mod_announcements']
                );
            }
        }
    }

    return $data;
}

//
// Add sanity checks
//
function mod_readable_dates_sanity_checks($sanity_checks) {
    if (    isset($sanity_checks)
         && is_array($sanity_checks) ) {
        $sanity_checks[] = array(
            'function'    => 'mod_readable_dates_do_sanity_checks',
            'description' => 'Readable Dates and Concealed Times Module'
        );
    }
    return $sanity_checks;
}

//
// Do sanity checks
//
function mod_readable_dates_do_sanity_checks() {
    global $PHORUM;

    include_once './include/version_functions.php';

    // Check if the Phorum version is high enough.
    if (phorum_compare_version(PHORUM, '5.2.7') == -1) {
          return array(
                     PHORUM_SANITY_CRIT,
                     'The Phorum version is not high enough.',
                     'This module needs at least Phorum version 5.2.7.'
                 );
    }

    // Check if module settings exists.
    if (    !isset($PHORUM['mod_readable_dates']['buddies'])
         || !isset($PHORUM['mod_readable_dates']['conceal_times'])
         || empty($PHORUM['mod_readable_dates']['granularity'])
         || !isset($PHORUM['mod_readable_dates']['index'])
         || !isset($PHORUM['mod_readable_dates']['list'])
         || !isset($PHORUM['mod_readable_dates']['mod_announcements'])
         || !isset($PHORUM['mod_readable_dates']['pm_list'])
         || !isset($PHORUM['mod_readable_dates']['pm_read'])
         || !isset($PHORUM['mod_readable_dates']['profile'])
         || !isset($PHORUM['mod_readable_dates']['read'])
         || !isset($PHORUM['mod_readable_dates']['read_userregdate'])
         || !isset($PHORUM['mod_readable_dates']['readable_numbers']) ) {
          return array(
                     PHORUM_SANITY_CRIT,
                     'The default settings for the module are missing.',
                     'Login as administrator in Phorum&#x2019;s '
                         .'administrative interface and go to the "Modules" '
                         .'section. Open the module settings for the Readable '
                         .'Dates and Concealed Times Module and save the '
                         .'default values.'
                 );
    }

    // Check if custom language file exists
    $checked = array();
    // Check for the default language file.
    if ( !file_exists
             ("./mods/readable_dates/lang/{$PHORUM['language']}.php")
       ) {
        return array(
            PHORUM_SANITY_WARN,
            'Your default language is set to "'
                .htmlspecialchars($PHORUM['language'])
                .'", but the language file "mods/readable_dates/lang/'
                .htmlspecialchars($PHORUM['language'])
                .'.php" is not available on your system.',
            'Install the specified language file to make this default '
                .'language work or change the Default Language setting under '
                .'General Settings.'
        );
    }
    $checked[$PHORUM['language']] = true;

    // Check for the forum specific language file(s).
    $forums = phorum_db_get_forums();
    foreach ($forums as $id => $forum) {
        if (    !empty($forum['language'])
             && !$checked[$forum['language']]
             && !file_exists("./mods/readable_dates/lang/{$forum['language']}.php")
           ) {
            return array(
                PHORUM_SANITY_WARN,
                'The language for forum "'
                    .htmlspecialchars($forum['name'])
                    .'" is set to "'
                    .htmlspecialchars($forum['language'])
                    .'", but the language file "mods/readable_dates/lang/'
                    .htmlspecialchars($forum['language'])
                    .'.php" is not available on your system.',
                'Install the specified language file to make this default '
                    .'language work or change the language setting for the '
                    .'forum.'
            );
        }
        $checked[$forum['language']] = true;
    }

    // Check if custom language file contains same array key as the english file
    $PHORUM['DATA']['LANG'] = array();
    include('./mods/readable_dates/lang/english.php');
    $orig_data = $PHORUM['DATA']['LANG'];
    $orig_keys = array_keys($PHORUM['DATA']['LANG']['mod_readable_dates']);
    // Check all files in the module language directory
    $tmphandle = opendir('./mods/readable_dates/lang/');
    if ($tmphandle) {
        while ($file = readdir($tmphandle)) {
            if ($file == '.' || $file == '..' || $file == 'english.php')
                continue;
            else
                $PHORUM['DATA']['LANG'] = array();
                include("./mods/readable_dates/lang/{$file}");
                $new_keys = array_keys($PHORUM['DATA']['LANG']['mod_readable_dates']);

                $missing_keys = array();

                foreach ($orig_keys as $id => $key) {
                    if (!in_array($key,$new_keys)) {
                        $missing_keys[$key] = $orig_data[$key];
                    }
                }

                if (count($missing_keys)) {
                    $tmpmessage
                        = 'The following keys are missing in your custom language file '.$file.':';
                    foreach ($missing_keys as $key => $val) {
                        $tmpmessage .= '<br />'.$key;
                    }
                    return array(
                               PHORUM_SANITY_CRIT,
                               $tmpmessage,
                               'Please add these keys to this language file!'
                           );
                }
        }
        closedir($tmphandle);
    } else {
        return array(
                   PHORUM_SANITY_CRIT,
                   'Error getting file list of module language files.',
                   'Check if the mods/readable_dates/lang/ directory exists.'
               );
    }

    return array(PHORUM_SANITY_OK, NULL, NULL);
}

?>
