<?php

namespace App\snipeit;

use Illuminate\Database\Eloquent\Model;

class Maintenances extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'asset_maintenances';

    protected $primaryKey = 'id';

    public $timestamps = false;


    protected $fillable = [
        'asset_id',
        'supplier_id',
        'asset_maintenance_type',
        'title',
        'is_warranty',
        'start_date',
        'completion_date',
        'asset_maintenance_time',
        'notes',
        'cost',
        'user_id',
        'deleted_at',
        'updated_at',
        'created_at'
    ];

    protected $guarded = [];
}
