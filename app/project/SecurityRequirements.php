<?php

namespace App\project;

use Illuminate\Database\Eloquent\Model;

class SecurityRequirements extends Model
{
    protected $table = 'project_catalog_security_requirements';

    protected $primaryKey = 'id';


    public $timestamps = false;

    protected $fillable = [
        'description',
        'status'
    ];

    public function getRequirement($id, $project)
    {
        $requiredValue = ProjectSecurityRequirements::where('project_catalog_security_requirements_id', $id)
            ->where('project_id', $project)
            ->value('required');

        return $requiredValue ?? '0';
    }
}
