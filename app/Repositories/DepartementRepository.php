<?php

namespace App\Repositories;

use App\Models\Departement;
use App\Repositories\BaseRepository;

/**
 * Class DepartementRepository
 * @package App\Repositories
 * @version December 11, 2019, 3:23 pm UTC
*/

class DepartementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'structure_id'
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
        return Departement::class;
    }
}
