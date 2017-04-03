<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;
use App\Http\Requests\NovoChamadoRequest;
use App\Models\Cliente;
use App\Models\Pedido;	
use App\Models\Chamado;

class CadChamadoController extends Controller
{
	
	
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth'); // anteriormente definida como guest.
	}

	
    public function open(){

		$data = array(
			'erro' => '',
			'success' => '',
			'ajax' => true,
		);
		return view('cadastro')->with('data', $data);
	}
	
    public function openSimples(){
		$data = array(
			'erro' => '',
			'success' => '',
			'ajax' => false,
		);
		return view('cadastro')->with('data', $data);
	}
	
	public function getEmail( Request $request){
		
		$resposta = DB::table('clientes')
		->where('email','=',$request->get('email'))
		->first();
		
		return Response::json($resposta);
		
	}
	
	public function getNumPedido( Request $request){
		
		$resposta = DB::table('pedidos')
		->where('numero_pedido','=',$request->get('pedido'))
		->first();
		
		return Response::json($resposta);
		
	}
	
	public function save( NovoChamadoRequest $request, Cliente $cliente, Pedido $pedido, Chamado $chamado ){
			
		$response = "Dados salvos com sucesso!";
		
		$data = array(
			'erro' => '',
			'success' => '',
			'ajax' => false,
		);
		
		
		$aux = Cliente::where('email', '=', $request->get('email'))
		->first();

		if( $aux == null ){
			$cliente->nome = $request->get('nome');
			$cliente->email = $request->get('email');
		}else{
			$cliente = $aux;
		}
		
		
		$aux = Pedido::where('numero_pedido', '=', $request->get('numero_pedido'))
		->first();
		
		if( $aux == null ){
			$pedido->numero_pedido = $request->get('numero_pedido');
		}
		else if( $aux->cliente_id == $cliente->id ){
			$pedido = $aux;
		}
		else{
			
			$response = "Erro: Erro este numero de pedido já pertence à outro usuário";
			
			if( $request->ajax() ){
				return Response::json( $response );
			}
			$data['erro'] = $response;
			return view('cadastro')->with( 'data', $data );
			
		}
		
		$chamado->titulo = $request->get('titulo');
			
		$chamado->observacao = $request->get('observacao');
		

		$cliente->save();

		$cliente->pedidos()->save( $pedido );
					
		$pedido->chamados()->save( $chamado );

		$data['success'] = $response;
		
		if( $request->ajax() ){
			return Response::json( $response );
		}
		return view('cadastro')->with('data', $data );
	}
	
}
