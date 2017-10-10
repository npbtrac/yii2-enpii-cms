<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 10/10/17 10:34 PM
 */

namespace enpii\enpiiCms\libs\helpers;

use enpii\enpiiCms\libs\helpers\NpBaseHelper as BaseHelper;

class NpSecurityHelper extends BaseHelper
{
    /**
     * @param string $strToHash string to be hashed
     * @param string $salt salt to add extra difficulty
     * @return string
     */
    public static function hashString($strToHash, $salt = '')
    {
        return md5($strToHash . $salt);
    }
}