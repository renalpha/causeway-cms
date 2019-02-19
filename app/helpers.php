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