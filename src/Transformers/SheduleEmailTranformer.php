<?php
namespace agoalofalife\postman\Transformers;

use Illuminate\Database\Eloquent\Model;
use Themsaid\Transformers\AbstractTransformer;

class SheduleEmailTranformer extends AbstractTransformer
{
    /**
     * @param Model $item
     * @return array
     */
    public function transformModel(Model $item)
    {
        return [
            trans('postman::dashboard.date') => $item->date,
            trans('postman::dashboard.theme') => $item->email->theme,
            trans('postman::dashboard.text') => $item->email->text,
            trans('postman::dashboard.mode') => $item->mode->name,
            trans('postman::dashboard.status') => $item->status_action,
        ];
    }
}