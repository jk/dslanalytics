<?php

namespace JK\DslAnalytics;

class Helper
{
    /**
     * @param DateTime $date
     * @return int
     */
    static public function hashToFirstIndex(\DateTime $date)
    {
        return intval($date->format('Ymd'));
    }

    /**
     * @param DateTime $date
     * @return int
     */
    static public function hashToSecondIndex(\DateTime $date)
    {
        $position = intval($date->format('H')) * 4;

        $minute = intval($date->format('i'));
        if ($minute >= 0 && $minute < 15) {
            $position += 0;
        } else {
            if ($minute >= 15 && $minute < 30) {
                $position += 1;
            } else {
                if ($minute >= 30 && $minute < 45) {
                    $position += 2;
                } else {
                    $position += 3;
                }
            }
        }

        return $position;
    }

    static public function indexToTime($index)
    {
        $hour = floor($index / 4);
        $minute = $index % 4;

        return ['hour' => $hour, 'minute' => $minute * 15];
    }

    static public function indexToTimeString($index)
    {
        $time = self::indexToTime($index);

        return $time['hour'] . ':' . sprintf("%02d", $time['minute']);
    }
}
