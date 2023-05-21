<?php

function is_active($route, $class)
{
    return Route::currentRouteNamed($route) ? $class : '';
}
