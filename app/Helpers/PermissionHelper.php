<?php

function is_access($permission)
{
    return auth()->user()->permissions()->pluck('slug')->contains($permission);
}

function is_setting($permission)
{
    return auth()->user()->permissions()->pluck('is_setting')->contains($permission);
}
