<?php

namespace App\Repositories;

use App\Models\Niveau;
use App\Repositories\BaseRepository;

/**
 * Class NiveauRepository
 * @package App\Repositories
 * @version December 10, 2019, 12:06 pm UTC
*/

class NiveauRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom'
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
        return Niveau::class;
    }
}
