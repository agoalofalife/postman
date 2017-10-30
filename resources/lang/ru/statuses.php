<?php
use agoalofalife\postman\Models\Status;

return [
   [
       'name' => 'В процессе',
       'description' => 'Это задача находится в процессе',
       'color_rgb' => '#c9e5f5',
       Status::COLUMN_UNIQUE_NAME => Status::IN_PROCESS,
   ],
    [
        'name' => 'Выполнена',
        'description' => 'Эта задача закончена.',
        'color_rgb' => '#e2f0e4',
        Status::COLUMN_UNIQUE_NAME => Status::DONE,
    ]
];