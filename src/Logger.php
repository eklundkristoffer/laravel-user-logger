<?php

namespace Eklundkristoffer\Logger;

use Exception;
use Eklundkristoffer\Logger\Observer;
use Illuminate\Database\Eloquent\Model;

class Logger
{
    public function watch($model)
    {
        $model = new $model;

        if (! $model instanceof Model) {
            throw new Exception('Not a model.');
        }

        $model->observe(new Observer);
    }

    public function log($user, $action, $params)
    {
        $date = now()->format('Y-m-d');

        $usernameKey = config('laravel-user-logger.username-column', 'username');

        if (! is_dir($folderPath = storage_path('laravel-user-logs/'.$user->{$usernameKey}))) {
            mkdir($folderPath);
        }

        if (! file_exists($logfile = storage_path('laravel-user-logs/'.$user->{$usernameKey}.'/'.$date.'.log'))) {
            file_put_contents($logfile, null);
        }

        file_put_contents($logfile, request()->ip().': ['.$date.' '.now()->format('H:i').']'.PHP_EOL.json_encode(['user' => $user, 'action' => $action, 'params' => $params]).PHP_EOL.PHP_EOL, FILE_APPEND);
    }
}
