<?php

namespace App\Repositories;

use App\Models\Sender;

class SenderRepository extends  ApiRepository
{

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sender::class;
    }

}
