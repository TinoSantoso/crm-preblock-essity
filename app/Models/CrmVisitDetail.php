<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrmVisitDetail extends Model
{
    protected $table = 'crm_visit_details';
    public $timestamps = false;
    protected $guarded = [];

    public function visit()
    {
        return $this->belongsTo(CrmVisit::class, 'trans_no', 'trans_no');
    }
}
