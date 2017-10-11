<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 10/11/17 11:53 AM
 */

namespace enpii\enpiiCms\libs\helpers;


class NpDateTimeHelper extends NpBaseHelper
{
    /**
     * Get datetime format to put to database. Use GMT time for database
     * @param string $format
     * @param null $timestamp
     * @return string
     */
    public static function toDbFormat($format = "Y-m-d H:i:s", $timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = time();
        }
        return date($format, $timestamp);
    }

    /**
     * Get datetime format to put to database. Use GMT time for database
     * @param string $format
     * @param null $timestamp
     * @return string
     */
    public static function toDbFormatGmt($format = "Y-m-d H:i:s", $timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = time();
        }
        return gmdate($format, $timestamp);
    }

    public static function fromDbFormat($input, $format = "Y-m-d H:i:s", $timezone = null)
    {
        $timezone = !$timezone ? $timezone : date_default_timezone_get();
        if (is_numeric($timezone)) {
            return date($format, strtotime($input . " $timezone hour"));
        } else {
            $date = new \DateTime($input);
            $date->setTimezone(new \DateTimeZone($timezone));

            return $date->format($format);
        }
    }
}