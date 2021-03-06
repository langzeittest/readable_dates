<?php
// date_format: Different pages use different date formats from language file
//              (short vers long); we need to know which date format we should
//              use. Short_date is default.
function mod_readable_dates_format_date($time, $orig = NULL, $readable_date = 1) {
    global $PHORUM;

    // Do not format empty time fields. Otherwise, we would process them
    // as January 1st, 1970 (epoch).
    if (empty($time)) return $orig === NULL ? '' : $orig;

    // If no original date was provided, then make on up ourselves,
    // based on the short date time format.
    if ($orig === NULL) $orig = phorum_date($PHORUM['short_date_time'], $time);

    $date_format = $PHORUM['short_date'];
    $limit = time() - (24 * 60 * 60);

    // Only conceal time?
    if (!$readable_date) {
        if ($time < $limit) {
            return phorum_date($date_format, $time);
        } else {
            return $orig;
        }
    }

    $granularity
        = empty($PHORUM['mod_readable_dates']['granularity']) ? 0 : $PHORUM['mod_readable_dates']['granularity'];
    $max_time
        = empty($PHORUM['mod_readable_dates']['max_time']) ? 0 : $PHORUM['mod_readable_dates']['max_time'];
    $reltime = time() - $time;

    // If the date is older than the maximum time from the settings,
    // then the original, standard formatted date should be used.
    if ($max_time && $reltime >= $max_time) {
        // Conceal time?
        if ($PHORUM['mod_readable_dates']['conceal_times']) {
            if ($time < $limit) {
                return phorum_date($date_format, $time);
            } else {
                return $orig;
            }
        } else {
            return $orig;
        }
    }

    $langkey = NULL;
    $count   = NULL;

    // Find out the relative date to use.
    // Concealing timestamps isn't necessary...
    if ($granularity < 60) {
        if ($reltime < 60) {
            $count = $reltime;
            $langkey = 'seconds_ago_';
        }
    }
    if ($langkey === NULL && $granularity <= 60) {
        $relminutes = (int)($reltime/60);
        if ($relminutes < 60) {
            $count = $relminutes;
            $langkey = 'minutes_ago_';
        }
    }
    if ($langkey === NULL && $granularity <= 3600) {
        $relhours = (int)($reltime/3600);
        if ($relhours < 24) {
            $count = $relhours;
            $langkey = 'hours_ago_';
        }
    }
    if ($langkey === NULL && $granularity <= 86400) {
        $today = strtotime(phorum_date('%Y-%m-%d', time()));
        if ($today <= $time) {
            $reldays = 0;
        } else {
            $reldays = ceil(($today - $time)/86400);
        }
        if ($reldays < 14) {
            $count = $reldays;
            $langkey = 'days_ago_';
        }
    }
    if ($langkey === NULL && $granularity <= 604800) {
        $relweeks = (int)((time() - $time)/604800);
        if ($relweeks < 8) {
            $count = $relweeks;
            $langkey = 'weeks_ago_';
        }
    }
    if ($langkey === NULL && $granularity <= 2628000) {
        $relmonths = (int)((time() - $time)/2628000);
        if ($relmonths < 12) {
            $count = $relmonths;
            $langkey = 'months_ago_';
        }
    }
    if ($langkey === NULL && $granularity <= 30758400) {
        $relyears = (int)((time() - $time)/30758400);
        $count = $relyears;
        $langkey = 'years_ago_';
    }

    $lang = $PHORUM['DATA']['LANG']['mod_readable_dates'];

    // Find the language string to use.
    // Check for a language key for the exact count.
    if (isset($lang[$langkey.$count])) {
        $str = $lang[$langkey.$count];
    } else {
        // Check for a language key for a count ending on a certain number.
        // This is required for supporting languages like Russian.
        $last_digit = intval(substr(strval($count), -1));
        if (isset($lang[$langkey.'x'.$last_digit])) {
            $str = $lang[$langkey.'x'.$last_digit];
        } else {
            // Any other count.
            $str = $lang[$langkey.'x'];
        }
    }

    // Translate numbers if a translation is available and if the
    // readable numbers feature is enabled.
    if (    $PHORUM['mod_readable_dates']['readable_numbers']
         && isset($lang[$count]) ) {
        $count = $lang[$count];
    }

    // Format the relative date.
    $str = str_replace('%count%', $count, $str);

    // Relative date language strings can contain strftime info.
    if (strpos($str, '%') !== FALSE) {
        $str = phorum_date($str, $time);
    }

    return $str;
}

?>
