<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = ['Fecha', 'Descripcion', 'Monto', 'Descuentos', 'MontoPendiente', 'fk_IdReservacion'];
    
    protected $table = 'Factura';
    protected $primaryKey = 'NumFactura';
    
}
