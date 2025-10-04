<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

if (!function_exists('gv')) {
    function gv($params, $key, $default = NULL)
    {
        return (isset($params[$key]) && $params[$key]) ? $params[$key] : $default;
    }
}

if (!function_exists('carbonDate')) {
    function carbonDate($data, $format = 'd-m-Y')
    {
        if ($data) {
            $data = Carbon::parse($data);
            return $data->format($format);
        } else {
            return NULL;
        }
    }
}

if (!function_exists('carbonDateByDayMonthYear')) {
    function carbonDateByDayMonthYear($data, $format = 'd-m-Y')
    {
        if ($data) {
            $data = Carbon::createFromFormat('d/m/Y', $data);
            return $data->format($format);
        } else {
            return NULL;
        }
    }
}


if (!function_exists('showDateFormat')) {
    function showDateFormat($input_date)
    {
        try {
            $system_date_format = 'jS M, Y';
            return date_format(date_create($input_date), $system_date_format);
        } catch (\Exception $th) {
            return $input_date;
        }
    }
}

if (!function_exists('showTimeFormat')) {
    function showTimeFormat($input_time)
    {
        try {
            $system_time_format = 'h:i A';
            return date_format(date_create($input_time), $system_time_format);
        } catch (\Exception $th) {
            return $input_time;
        }
    }
}

if (!function_exists('showDefaultImage')) {
    function showDefaultImage($path) : string
    {
        if($path && file_exists($path)){
            // Remove leading and trailing slashes, then explode by '/'
            $segments = explode('/', trim($path, '/'));

            $storageIndex = array_search('storage', $segments);

            if ($storageIndex !== false && count($segments) > $storageIndex + 1) {
                return asset($path);
            } else {
                return asset('img/default.png');
            }
        }else{
            return asset('img/default.png');
        }
    }
}


if (!function_exists('isActiveMenu')) {
    function isActiveMenu(array $routes)
    {
        foreach ($routes as $route) {
            if (Route::is($route)) {
                return true;
            }
        }

        return false;
    }
}


if (!function_exists('convert_number')) {
    function convert_number($number = false)
    {
        $my_number = $number;

        if (($number < 0) || ($number > 99999999999)) {
            throw new Exception("Number is out of range");
        }
        $Kt = floor($number / 10000000); /* Koti */
        $number -= $Kt * 10000000;
        $Gn = floor($number / 100000);  /* lakh  */
        $number -= $Gn * 100000;
        $kn = floor($number / 1000);     /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);      /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);       /* Tens (deca) */
        $n = $number % 10;               /* Ones */

        $res = "";

        if ($Kt) {
            $res .= convert_number($Kt) . " Crore ";
        }
        if ($Gn) {
            $res .= convert_number($Gn) . " Lakh";
        }

        if ($kn) {
            $res .= (empty($res) ? "" : " ") .
                convert_number($kn) . " Thousand";
        }

        if ($Hn) {
            $res .= (empty($res) ? "" : " ") .
                convert_number($Hn) . " Hundred";
        }

        $ones = array(
            "",
            "One",
            "Two",
            "Three",
            "Four",
            "Five",
            "Six",
            "Seven",
            "Eight",
            "Nine",
            "Ten",
            "Eleven",
            "Twelve",
            "Thirteen",
            "Fourteen",
            "Fifteen",
            "Sixteen",
            "Seventeen",
            "Eightteen",
            "Nineteen"
        );
        $tens = array(
            "",
            "",
            "Twenty",
            "Thirty",
            "Fourty",
            "Fifty",
            "Sixty",
            "Seventy",
            "Eigthy",
            "Ninety"
        );

        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }

            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];

                if ($n) {
                    $res .= "-" . $ones[$n];
                }
            }
        }

        if (empty($res)) {
            $res = "zero";
        }

        return $res;
    }
    if (!function_exists('getSetting')) {
        function getSetting(string $type): ?string
        {
            return DB::table('general_settings')
                ->where('type', $type)
                ->value('value');
        }
    }
}
