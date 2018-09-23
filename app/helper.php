<?php

/**
 * /servers/{exp_group}/{mode}/{sort}/{orderBy}
 *
 * @param string $exp_group
 * @param string $mode
 * @param string $column_name
 * @param string $orderBy
 * @return string
 */
function filter_query($exp_group = "all", $mode = "any", $column_name = "all", $orderBy = 'desc')
{
    return route('filter.query', [$exp_group, $mode, $column_name, $orderBy]);
}