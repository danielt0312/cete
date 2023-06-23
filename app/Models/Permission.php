<?php
// namespace App;
namespace App\Models;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // use HasFactory;
    // driver para conectarse a otra BD
    protected $connection = "seguridad";
    
}