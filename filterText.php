<?php

function replace_dirty_words($text, array $badWords)
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

        $badWord = '/(?i)' . $badWord . '?\w+/m';

        preg_match_all($badWord, $text, $matches);

        $matches = call_user_func_array('array_merge', $matches);

        foreach ($matches as $match) {

            $text = str_replace($match, str_repeat('*', strlen($match)), $text);

        }

    }

    return $text;

}

echo replace_dirty_words("I am a fucking genius and I don't give a fuck.", ['fuck']);