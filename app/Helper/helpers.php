<?php

function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return \Illuminate\Support\Str::limit($excerpt, $length);
}
