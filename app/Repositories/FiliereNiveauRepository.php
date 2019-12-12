<?php

namespace App\Repositories;

use App\Models\FiliereNiveau;
use App\Repositories\BaseRepository;

/**
 * Class FiliereNiveauRepository
 * @package App\Repositories
 * @version December 10, 2019, 5:29 pm UTC
*/

class FiliereNiveauRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'filiere_id',
        'niveau_id'
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
        return FiliereNiveau::class;
    }
}
