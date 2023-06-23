<?php
// namespace App;
namespace App\Models;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;
class Role extends SpatieRole
{
    use SoftDeletes;
    // driver para conectarse a otra BD
    protected $connection = "seguridad";
    
}