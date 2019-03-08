<?php

if (!function_exists('inputOld')) {
    function inputOld($name, $model = null)
    {
        return old($name, request($name) ?? $model ?? null);
    }
}

if (!function_exists('accessLevelList')) {
    function accessLevelList()
    {
        return [
            '' => 'Public',
            'admin' => 'Admin',
            'user' => 'User',
        ];
    }
}

if (!function_exists('cmsDate')) {
    function cmsDateTime($value, $format = 'j M Y H:i')
    {
        if (isset($value) && !empty($value)) {
            return \Carbon\Carbon::parse($value)->format($format);
        }
        return null;
    }
}