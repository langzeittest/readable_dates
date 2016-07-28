<?php
$PHORUM['DATA']['LANG']['mod_readable_dates'] = array
(
    'seconds_ago_0' => 'hace 0 segundos',
    'seconds_ago_1' => 'hace %count% segundo',
    'seconds_ago_x' => 'hace %count% segundos',

    'minutes_ago_0' => 'hace 0 minutos',
    'minutes_ago_1' => 'hace %count% minuto',
    'minutes_ago_x' => 'hace %count% minutos',

    'hours_ago_0'   => 'esta hora',
    'hours_ago_1'   => 'hace %count% hora',
    'hours_ago_x'   => 'hace %count% horas',

    'days_ago_0'    => 'hoy, %I:%M%p',
    'days_ago_1'    => 'ayer, '
                         .( (    isset($PHORUM['mod_readable_dates']['conceal_times'])
                              && $PHORUM['mod_readable_dates']['conceal_times'] )?'':', %I:%M%p' ),
    'days_ago_x'    => 'hace %count% días',

    'weeks_ago_0'   => 'esta semana',
    'weeks_ago_1'   => 'hace 1 semana',
    'weeks_ago_x'   => 'hace %count% semanas',

    'months_ago_0'  => 'este mes',
    'months_ago_1'  => 'hace 1 mes',
    'months_ago_x'  => 'hace %count% meses',

    'years_ago_0'   => 'este año',
    'years_ago_1'   => 'hace 1 año',
    'years_ago_x'   => 'hace %count% años',

    // Text representations for numbers.
    // These will be used for the %count% replacements in the above
    // language strings. If no translations are provided, then %count%
    // will be replaced by the numerical representation.
    '1'             => 'one',
    '2'             => 'two',
    '3'             => 'three',
    '4'             => 'four',
    '5'             => 'five',
    '6'             => 'six',
    '7'             => 'seven',
    '8'             => 'eight',
    '9'             => 'nine',
    '10'            => 'ten',
    '11'            => 'eleven',
    '12'            => 'twelve',
    '13'            => 'thirteen',
    '14'            => 'fourteen',
    '15'            => 'fifteen',
    '16'            => 'sixteen',
    '17'            => 'seventeen',
    '18'            => 'eighteen',
    '19'            => 'nineteen',
    '20'            => 'twenty',

    // This language string is used to override the default
    // "EditedMessage" language string from the main language file,
    // to make the modified edit message sound better in combination
    // with a readable date.
    'edit_message'  => 'Edited %count% time(s). Last edit was %lastedit% by %lastuser%.'
);

?>
