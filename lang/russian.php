<?php
$PHORUM['DATA']['LANG']['mod_readable_dates'] = array
(
    'seconds_ago_0'  => 'сейчас',
    'seconds_ago_1'  => 'секунду назад',
    'seconds_ago_11' => '%count% секунд назад',
    'seconds_ago_12' => '%count% секунд назад',
    'seconds_ago_13' => '%count% секунд назад',
    'seconds_ago_14' => '%count% секунд назад',
    'seconds_ago_x1' => '%count% секунду назад',
    'seconds_ago_x2' => '%count% секунды назад',
    'seconds_ago_x3' => '%count% секунды назад',
    'seconds_ago_x4' => '%count% секунды назад',
    'seconds_ago_x'  => '%count% секунд назад',

    'minutes_ago_0'  => 'менее минуты назад',
    'minutes_ago_1'  => 'минуту назад',
    'minutes_ago_11' => '%count% минут назад',
    'minutes_ago_12' => '%count% минут назад',
    'minutes_ago_13' => '%count% минут назад',
    'minutes_ago_14' => '%count% минут назад',
    'minutes_ago_x1' => '%count% минуту назад',
    'minutes_ago_x2' => '%count% минуты назад',
    'minutes_ago_x3' => '%count% минуты назад',
    'minutes_ago_x4' => '%count% минуты назад',
    'minutes_ago_x'  => '%count% минут назад',

    'hours_ago_0'    => 'менее часа назад',
    'hours_ago_1'    => 'час назад',
    'hours_ago_11'   => '%count% часов назад',
    'hours_ago_12'   => '%count% часов назад',
    'hours_ago_13'   => '%count% часов назад',
    'hours_ago_14'   => '%count% часов назад',
    'hours_ago_x1'   => '%count% час назад',
    'hours_ago_x2'   => '%count% часа назад',
    'hours_ago_x3'   => '%count% часа назад',
    'hours_ago_x4'   => '%count% часа назад',
    'hours_ago_x'    => '%count% часов назад',

    'days_ago_0'     => 'сегодня, %I:%M%p',
    'days_ago_1'     => 'вчера, '
                          .( (    isset($PHORUM['mod_readable_dates']['conceal_times'])
                               && $PHORUM['mod_readable_dates']['conceal_times'] )?'':', %I:%M%p' ),
    'days_ago_11'    => '%count% дней назад',
    'days_ago_x1'    => '%count% день назад',
    'days_ago_x2'    => '%count% дня назад',
    'days_ago_x3'    => '%count% дня назад',
    'days_ago_x4'    => '%count% дня назад',
    'days_ago_x'     => '%count% дней назад',

    'weeks_ago_0'    => 'на этой неделе',
    'weeks_ago_1'    => 'на прошлой неделе',
    'weeks_ago_11'   => '%count% недель назад',
    'weeks_ago_12'   => '%count% недель назад',
    'weeks_ago_13'   => '%count% недель назад',
    'weeks_ago_14'   => '%count% недель назад',
    'weeks_ago_x1'   => '%count% неделю назад',
    'weeks_ago_x2'   => '%count% недели назад',
    'weeks_ago_x3'   => '%count% недели назад',
    'weeks_ago_x4'   => '%count% недели назад',
    'weeks_ago_x'    => '%count% недель назад',

    'months_ago_0'   => 'в этом месяце',
    'months_ago_1'   => 'в прошлом месяце',
    'months_ago_11'  => '%count% месяцев назад',
    'months_ago_12'  => '%count% месяцев назад',
    'months_ago_13'  => '%count% месяцев назад',
    'months_ago_14'  => '%count% месяцев назад',
    'months_ago_x1'  => '%count% месяц назад',
    'months_ago_x2'  => '%count% месяца назад',
    'months_ago_x3'  => '%count% месяца назад',
    'months_ago_x4'  => '%count% месяца назад',
    'months_ago_x'   => '%count% месяцев назад',

    'years_ago_0'    => 'в этом году',
    'years_ago_1'    => 'в прошлом году',
    'years_ago_11'   => '%count% лет назад',
    'years_ago_12'   => '%count% лет назад',
    'years_ago_13'   => '%count% лет назад',
    'years_ago_14'   => '%count% лет назад',
    'years_ago_x1'   => '%count% год назад',
    'years_ago_x2'   => '%count% года назад',
    'years_ago_x3'   => '%count% года назад',
    'years_ago_x4'   => '%count% года назад',
    'years_ago_x'    => '%count% лет назад',

    // Text representations for numbers.
    // These will be used for the %count% replacements in the above
    // language strings. If no translations are provided, then %count%
    // will be replaced by the numerical representation.
    '1'              => 'одну',
    '2'              => 'две',
    '3'              => 'три',
    '4'              => 'четыре',
    '5'              => 'пять',
    '6'              => 'шесть',
    '7'              => 'семь',
    '8'              => 'восемь',
    '9'              => 'девять',
    '10'             => 'десять',
    '11'             => 'одинадцать',
    '12'             => 'двенадцать',
    '13'             => 'тринадцать',
    '14'             => 'четырнадцать',
    '15'             => 'пятнадцать',
    '16'             => 'шестнадцать',
    '17'             => 'семнадцать',
    '18'             => 'восемнадцать',
    '19'             => 'девятнадцать',
    '20'             => 'двадцать',

    // This language string is used to override the default
    // "EditedMessage" language string from the main language file,
    // to make the modified edit message sound better in combination
    // with a readable date.
    'edit_message'   => 'Редактировано %count% раза. Последний раз редактировано %lastedit% пользователем %lastuser%.'
);

?>
