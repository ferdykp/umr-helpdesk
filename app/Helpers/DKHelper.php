<?php

namespace App\Helpers;

class DKHelper
{
    public static function arrayExplode($data)
    {
        if (is_array($data)) {
            $data = implode(',', $data);
        }
        $xdata = str_replace(", ", ",", $data);
        $xdata = str_replace("~", " ", $xdata);
        $rdata = array();
        if (strlen($xdata) > 0) {
            $rdata = explode(",", $xdata);
        }
        return $rdata;
    }
}