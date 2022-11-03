<?php

namespace App\Utill;

class Utill
{

    public function __construct()
    {
    }
    /**
     * Escape string in sql query
     *
     * @param  string $input
     * @return string
     */
    public function sqlEscape($input = '')
    {
        if ($input === NULL) {
            $input = NULL;
        }
        $input = str_replace('[', '[[]', $input);
        $input = str_replace('%', '[%]', $input);
        $input = str_replace('_', '[_]', $input);
        $input = str_replace('\\', '[\\]', $input);
        $input = str_replace('\'', '\'\'', $input);
        //
        return $input;
    }
}
