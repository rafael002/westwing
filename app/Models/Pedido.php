<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function chamados(){
			return $this->hasMany( 'App\Models\Chamado' );
	}
}
