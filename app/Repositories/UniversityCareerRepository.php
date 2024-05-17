<?php

namespace App\Repositories;

use App\Contracts\Repositories\UniversityCareerRepositoryInterface;
use App\Models\UniversityCareer;

class UniversityCareerRepository implements UniversityCareerRepositoryInterface
{
    public function all()
    {
        return UniversityCareer::all();
    }


}
