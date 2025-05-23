<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModele extends Model
{
    use SoftDeletes;
    
    //commun fields in the base class
    protected $fillable = [
                            'created_by', 
                            'updated_by',
                            'deleted_by',
                        ];
    
    // Common casts in the base class
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    //constructor for commun field and commun casts
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->fillable = array_unique(array_merge($this->fillable, $this->getFillable()));
        $this->casts = array_merge($this->casts, $this->getCasts());
    }

    /**
     * Allows child classes to define additional fillable attributes.
     */
    public function getFillable()
    {
        return [];
    }

    /**
     * Get the attributes that should be cast.
     */
    public function getCasts()
    {
        return [];
    }

    //Supression avec enregistrement de l'utilisateur
    public function softDeleteWithUser($userId)
    {
        $this->update(['deleted_by' => $userId]);
        $this->delete();
    }
}
