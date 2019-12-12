<?php

namespace App\Repositories;

use App\Models\Filiere;
use App\Repositories\BaseRepository;

/**
 * Class FiliereRepository
 * @package App\Repositories
 * @version December 10, 2019, 12:06 pm UTC
*/

class FiliereRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'universite_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Filiere::class;
    }
}
