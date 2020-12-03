<?php

function TaskCountArray($projects)
{
    $counts = [];
    foreach ($projects as $project) {
        $projectCount =  $project->tasks->count();
        array_push($counts, $projectCount);
    }
    return json_encode($counts);
}
