<?php

namespace Eklundkristoffer\Logger;

use Illuminate\Support\Facades\Auth;
use \Facades\Eklundkristoffer\Logger\Logger;

class Observer
{
    public function created($model)
    {
        Logger::log(Auth::user(), 'model:created', ['namespace' => get_class($model), 'model' => $model]);
    }

    public function updated($model)
    {
        $changes = array();

        foreach($model->getDirty() as $key => $value){
            $original = $model->getOriginal($key);

            $changes[$key] = [
                'old' => $original,
                'new' => $value,
            ];
        }

        Logger::log(Auth::user(), 'model:updated', ['namespace' => get_class($model), 'changes' => json_encode($changes)]);
    }

    public function deleted($model)
    {
        Logger::log(Auth::user(), 'model:deleted', ['namespace' => get_class($model), 'model' => $model]);
    }
}
