<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmVisit extends Model
{
    protected $table = 'crm_visits';
    public $timestamps = false;
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(CrmVisitDetail::class, 'trans_no', 'trans_no');
    }
}
