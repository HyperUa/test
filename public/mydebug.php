<?php


    function d($text = null)
    {
        dd($text);
        die;
    }

    function dd($text = null)
    {
        echo '<pre>';
        var_dump($text);
        echo '</pre>';
    }