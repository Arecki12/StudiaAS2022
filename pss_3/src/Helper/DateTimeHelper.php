<?php

namespace App\Helper;

use DateTime;
use Exception;

class DateTimeHelper
{
    public const DATETIME_FORMAT = 'Y-m-d H:i:s';

    public const DATETIME_FORMAT_ONLY_TIME = 'H:i:s';

    public const DATETIME_FORMAT_WITHOUT_TIME = 'Y-m-d';

    /**
     * @param string $dateTimeValue Accepted values: Days, Months, Years or Hours, Minutes, Seconds
     * @return string
     * @throws Exception
     */
    public static function getDateTypeByDateTimeValue(string $dateTimeValue): string
    {
        return match ($dateTimeValue) {
            'days' => 'D',
            'months', 'minutes' => 'M',
            'years' => 'Y',
            'hours' => 'H',
            'seconds' => 'S',
            default => throw new Exception('Invalid interval type.'
                . 'Accepted values: Days, Months, Years or Hours, Minutes, Seconds. Provided value: '
                . $dateTimeValue),
        };
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param string $type
     * @return int
     * @throws Exception
     */
    public static function getTimeDifferenceByTimeStamps(string $startDate, string $endDate, string $type): int
    {
        $startDate = new DateTime($startDate);
        $endDate = new DateTime($endDate);
        return $startDate->diff($endDate)->$type;
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @return int
     */
    public static function getDateTimeDifferenceInMinutes(string $startDate, string $endDate): int
    {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        return round(abs($startDate - $endDate) / 60,2);
    }

    /**
     * @param string $dateTimeValue Accepted values: Days, Months, Years or Hours, Minutes, Seconds
     * @throws Exception
     */
    public static function getDateTimePrefixAndSuffix(string $dateTimeValue): ?array
    {
        return match ($dateTimeValue = strtolower($dateTimeValue)) {
            'days', 'years', 'months' => ['P', self::getDateTypeByDateTimeValue($dateTimeValue)],
            'hours', 'minutes', 'seconds' => ['PT', self::getDateTypeByDateTimeValue($dateTimeValue)],
            default => throw new Exception('Invalid dateTime value. Accepted values: Days, Months, Years or Hours, Minutes, Seconds'),
        };
    }
}