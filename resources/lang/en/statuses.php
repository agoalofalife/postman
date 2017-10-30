<?php
use agoalofalife\postman\Models\Status;

return [
   [
       'name' => 'In process',
       'description' => 'This task is in the process',
       'color_rgb' => '#c9e5f5',
       Status::COLUMN_UNIQUE_NAME => Status::IN_PROCESS,
   ],
    [
        'name' => 'Done',
        'description' => 'It is the task finished',
        'color_rgb' => '#e2f0e4',
        Status::COLUMN_UNIQUE_NAME => Status::DONE,
    ]
];