<?php

namespace App\Repository\Eloquents;

use App\Repository\Eloquents\BaseRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}
