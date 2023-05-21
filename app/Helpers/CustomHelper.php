<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Route;

function bk_rand($type, $param = null, $length = 13)
{
    $numbers = '0123456789';
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $prefix  = is_null($param) ? null : $param . '-';

    switch ($type)
    {
        case 'number':
            $result = substr(str_shuffle($numbers), 0, $length);
            break;

        case 'string':
            $result = substr(str_shuffle($letters), 0, $length);
            break;

        case 'login':
            $result = $prefix . substr(str_shuffle($numbers), 0, $length);
            break;

        default:
            $result = substr(str_shuffle($numbers . $letters), 0, $length);
            break;
    }

    return $result;
}

function bk_code($group, $date, $time)
{
    $formattedTime = str_replace(':', '', $time);
    $formattedDate = explode('-', $date);
    $year          = $formattedDate[0];
    $month         = strlen($formattedDate[1]) == 1 ? '0' . $formattedDate[1] : $formattedDate[1];
    $day           = strlen($formattedDate[2]) == 1 ? '0' . $formattedDate[2] : $formattedDate[2];

    return $group . $year . $month . $day . $formattedTime;
}

function is_active($route, $class)
{
    return Route::currentRouteNamed($route) ? $class : '';
}

function is_access($permission)
{
    return Auth::user()->permissions()->pluck('slug')->contains($permission);
}

function is_setting($permission)
{
    return Auth::user()->permissions()->pluck('is_setting')->contains($permission);
}

function double($amount, $decimal = 2)
{
    echo number_format($amount, $decimal, '.', ' ');
}

function fa($icon)
{
    echo '<i class="fa ' . $icon . '"></i>';
}

function form_title($param)
{
    echo $param ?? null ? __('_record.edit') : __('_record.new');
}

function tip($message)
{
    echo '<span class="bk-field bk-field--tip">' . $message .'</span>';
}

function no_record($record, $replace = null)
{
    echo $record ?? null ? $record : '<span class="text-info">' . $replace .'</span>';
}

function status($param)
{
    echo $param == 0
        ? '<strong class="text-info">' . __('_action.pending') .'</strong>'
        : '<strong class="text-success">' . __('_action.completed') .'</strong>';
}

