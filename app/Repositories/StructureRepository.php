<?php

namespace App\Repositories;

use App\Models\Structure;
use App\Repositories\BaseRepository;

/**
 * Class StructureRepository
 * @package App\Repositories
 * @version December 11, 2019, 1:40 pm UTC
*/

class StructureRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'sigle',
        'logo',
        'telephone',
        'email',
        'password',
        'site_web',
        'acces',
        'pro',
        'message_bonus',
        'message_payer'
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
        return Structure::class;
    }
}
