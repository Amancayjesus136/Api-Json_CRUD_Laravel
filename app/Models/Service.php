<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client; // Importa la clase Client aquí

class Service extends Model
{
    use HasFactory;
    
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'clients_services');
    }
}

