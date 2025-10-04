<?php

namespace App\Repository\Eloquents;

use App\Models\User;
use App\Repository\Eloquents\BaseRepository;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
