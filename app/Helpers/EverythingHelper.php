<?php

/**
 * /servers/{exp_group}/{mode}/{sort}/{orderBy}
 *
 * @param string $exp_group
 * @param string $mode
 * @param string $sorting
 * @param string $orderBy
 * @return string
 */
function filter_query($exp_group = "all", $mode = "any", $sorting = "all", $orderBy = 'desc')
{
    return route('filter.query', [$exp_group, $mode, $sorting, $orderBy]);
}

/**
 * @return \Faker\Generator
 */
function fake()
{
    return \Faker\Factory::create();
}

function trend_calculate()
{
    return round(((2 - 1) / 1) * 100, 2);
}