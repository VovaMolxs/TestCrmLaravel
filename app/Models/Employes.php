<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employes extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'note',
        'companies_id'
    ];

    public static function getAll() {
        $data = DB::table('companies')
            ->RightJoin('employes', 'companies.id', '=', 'employes.companies_id')
            ->select('employes.id','employes.first_name', 'employes.last_name', 'employes.email', 'employes.phone', 'employes.note', 'companies.name')->get();
        return $data;
    }
}
