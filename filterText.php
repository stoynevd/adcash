<?php

function removeBadWords($text, array $badWords)
{

    try {

        if (count($badWords) <= 0 || $text == '') {
            return 'Both parameters are required';
        }

        return adjustBadWords($text, $badWords);

    } catch (Exception $e) {
        echo $e->getMessage();
    }

}

function adjustBadWords($text, $badWords)
{

    foreach ($badWords as $badWord) {

        $badWord = '/' . $badWord . '?\w+/m';

        preg_match_all($badWord, $text, $matches);

        $matches = call_user_func_array('array_merge', $matches);

        foreach ($matches as $match) {

            $text = str_replace($match, str_repeat('*', strlen($match)), $text);

        }

    }

    return $text;

}

echo removeBadWords("You piece of fucking shit, fuck you", ['fuck', 'shit']);