<?php
return [
      // CreateTaskRequest
      'createTask.date.required' => 'Поле дата обязательно',
      'createTask.date.date_format' => 'Формат даты должен быть Y-m-d H:i:s',
      'createTask.theme.required' => 'Поле тема обязательно',
      'createTask.text.required' => 'Поле текст обязательно',
      'createTask.mode.required' => 'Поле тип отправки обязательно',
      'createTask.mode.exists' => 'Тип отправки не найден в таблице',
      'createTask.users.required' => 'Не меньше одного пользователя',
      'createTask.users.array' => 'Поле пользователи должен быть массивом',
      'createTask.users.*.required' => 'Не меньше одного пользователя',
      'createTask.users.*.exists' => 'Пользователь не найден в таблице',


];