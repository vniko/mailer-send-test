<?php

namespace App\Repositories;

use App\Jobs\SendMailMessage;
use App\Models\MailMessage;
use App\Models\Sender;

class MailMessageRepository extends  ApiRepository
{

    /**
     * Configure the Model
     **/
    public function model()
    {
        return MailMessage::class;
    }

    public function create($input)
    {

        $model = $this->model->newInstance($input);

        if (!empty($input['attachments']) && is_array($input['attachments'])) {
            $paths = [];
            foreach ($input['attachments'] as $file) {
                $path = $file->storeAs(
                    '/', $file->getClientOriginalName(), 'attachments'
                );
                $paths[] = $path;

            }
            $model->attachments = $paths;
        }

        $model->save();

        // queue message
        SendMailMessage::dispatch($model);

        return $model;
    }
}
