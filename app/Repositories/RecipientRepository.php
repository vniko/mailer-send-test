<?php

namespace App\Repositories;

use App\Models\Recipient;

class RecipientRepository extends  ApiRepository
{

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Recipient::class;
    }

}
