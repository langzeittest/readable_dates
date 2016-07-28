<?php
$PHORUM['DATA']['LANG']['mod_readable_dates'] = array
(
    'seconds_ago_0' => '&agrave; l&rsquo;instant',
    'Seconds_ago_1' => 'il y a %count% seconde',
    'seconds_ago_x' => 'il y a %count% secondes',

    'minutes_ago_0' => 'cette minute',
    'minutes_ago_1' => 'il y %count% minute',
    'minutes_ago_x' => 'il y a %count% minutes',

    'hours_ago_0'   => 'cette heure',
    'hours_ago_1'   => 'il y a %count% heure',
    'hours_ago_x'   => 'il y a %count% heures',

    'days_ago_0'    => 'aujourd&rsquo;hui, %I:%M%p',
    'days_ago_1'    => 'hier, '
                         .( (    isset($PHORUM['mod_readable_dates']['conceal_times'])
                              && $PHORUM['mod_readable_dates']['conceal_times'] )?'':', %I:%M%p' ),
    'days_ago_x'    => 'il y a %count% jours',

    'weeks_ago_0'   => 'cette semaine',
    'weeks_ago_1'   => 'la semaine derni&egrave;re',
    'weeks_ago_x'   => 'il y a %count% semaines',

    'months_ago_0'  => 'ce mois',
    'months_ago_1'  => 'le mois dernier',
    'months_ago_x'  => 'il y a %count% mois',

    'years_ago_0'   => 'cette ann&eacute;e',
    'years_ago_1'   => 'l&rsquo;an pass&eacute;',
    'years_ago_x'   => 'il y a %count% ann&eacute;es',

    // Text representations for numbers.
    // These will be used for the %count% replacements in the above
    // language strings. If no translations are provided, then %count%
    // will be replaced by the numerical representation.
    '1'             => 'une',
    '2'             => 'deux',
    '3'             => 'trois',
    '4'             => 'quatre',
    '5'             => 'cinq',
    '6'             => 'six',
    '7'             => 'sept',
    '8'             => 'huit',
    '9'             => 'neuf',
    '10'            => 'dix',
    '11'            => 'onze',
    '12'            => 'douze',
    '13'            => 'treize',
    '14'            => 'quatorze',
    '15'            => 'quinze',
    '16'            => 'seize',
    '17'            => 'dix sept',
    '18'            => 'dix huit',
    '19'            => 'dix neuf',
    '20'            => 'vingt',

    // This language string is used to override the default
    // "EditedMessage" language string from the main language file,
    // to make the modified edit message sound better in combination
    // with a readable date.
    'edit_message'  => 'Edit&eacute; %count% foi(s). La derni&egrave;re correction date de %lastedit% et a &eacute;t&eacute; effectu&eacute;e par %lastuser%.'
);

?>
