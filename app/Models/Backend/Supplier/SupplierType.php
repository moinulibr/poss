<?php

namespace App\Models\Backend\Supplier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SupplierType extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'supplier_typies';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'name','description','company_name','address','note','verified','deleted_at','verified_by','created_by'
    ];
}
