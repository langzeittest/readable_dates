<?php
$PHORUM['DATA']['LANG']['mod_readable_dates'] = array
(
    'seconds_ago_0' => 'μόλις τώρα',
    'seconds_ago_1' => 'πρίν %count% δευτερόλεπτο',
    'seconds_ago_x' => 'πρίν %count% δευτερόλεπτα',

    'minutes_ago_0' => 'αυτό το λεπτό',
    'minutes_ago_1' => 'πρίν %count% λεπτά',
    'minutes_ago_x' => 'πρίν %count% λεπτά',

    'hours_ago_0'   => 'αυτή την ώρα',
    'hours_ago_1'   => 'πρίν %count% ώρα',
    'hours_ago_x'   => 'πρίν %count% ώρες',

    'days_ago_0'    => 'σήμερα, %I:%M%p',
    'days_ago_1'    => 'χθές, '
                         .( (    isset($PHORUM['mod_readable_dates']['conceal_times'])
                              && $PHORUM['mod_readable_dates']['conceal_times'] )?'':', %I:%M%p' ),
    'days_ago_x'    => 'πρίν %count% μέρες',

    'weeks_ago_0'   => 'αυτή την εβδομάδα',
    'weeks_ago_1'   => 'τη προηγούμενη εβδομάδα',
    'weeks_ago_x'   => 'πρίν %count% εβδομάδες',

    'months_ago_0'  => 'αυτό το μήνα',
    'months_ago_1'  => 'το προηγούμενο μήνα',
    'months_ago_x'  => 'πρίν %count% μήνες',

    'years_ago_0'   => 'φέτος',
    'years_ago_1'   => 'πέρσι',
    'years_ago_x'   => 'πρίν %count% χρόνια',

    // Text representations for numbers.
    // These will be used for the %count% replacements in the above
    // language strings. If no translations are provided, then %count%
    // will be replaced by the numerical representation.
    '1'             => 'μία',
    '2'             => 'δύο',
    '3'             => 'τρείς',
    '4'             => 'τέσσερις',
    '5'             => 'πέντε',
    '6'             => 'έξι',
    '7'             => 'επτά',
    '8'             => 'οκτώ',
    '9'             => 'εννιά',
    '10'            => 'δέκα',
    '11'            => 'ένδεκα',
    '12'            => 'δώδεκα',
    '13'            => 'δεκατρείς',
    '14'            => 'δεκατέσσερις',
    '15'            => 'δεκαπέντε',
    '16'            => 'δεκαέξι',
    '17'            => 'δεκαεπτά',
    '18'            => 'δεκαοκτώ',
    '19'            => 'δεκαεννέα',
    '20'            => 'είκοσι',

    // This language string is used to override the default
    // "EditedMessage" language string from the main language file,
    // to make the modified edit message sound better in combination
    // with a readable date.
    'edit_message'  => 'Επεξεργάσθηκε %count% φορές. Τελευταία, επεξεργάστηκε %lastedit% από %lastuser%.'
);

?>
