<?php

/**
 * @param string $exp_group
 * @param string $mode
 * @param string $column_name
 * @param string $orderBy
 *
 * @return string
 */
function ColorScaleCounter($number)
{
    if ($number > 7)
        return '<span class="text-green">'.$number.'</span>';
    if ($number > 4)
        return '<span class="text-orange">'.$number.'</span>';
    else
        return '<span class="text-red">'.$number.'</span>';
}