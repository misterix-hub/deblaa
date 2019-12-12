<?php

namespace App\Repositories;

use App\Models\Universite;
use App\Repositories\BaseRepository;

/**
 * Class UniversiteRepository
 * @package App\Repositories
 * @version December 10, 2019, 12:48 pm UTC
*/

class UniversiteRepository extends BaseRepository
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
        'acces'
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
        return Universite::class;
    }
}
