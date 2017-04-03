<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Carbon\Carbon;

use App\Http\Requests;
use App\Models\Pedido;
use App\Models\Chamado;

class RelatorioController extends Controller
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

	public function apagar( Request $request ){
		
		$chamado = Chamado::where( 'id','=',$request->id )
		->first();
		
		$qtd = Chamado::where( 'pedido_id','=', $chamado->pedido_id )
		->count();
		
		$chamado->delete();
		
		if( $qtd < 2 ){
			Pedido::where( 'id','=', $chamado->pedido_id )->delete();
		}
		
		return Response::json("numero pedido_id: " . $chamado->pedido_id );
	}
	
	
	public function detalhe( Request $request ){
		
		$chamado = Chamado::join('pedidos', 'pedidos.id','=', 'chamados.pedido_id')
		->join('clientes', 'pedidos.cliente_id', '=', 'clientes.id')
		->select( 'clientes.*', 'pedidos.*', 'chamados.*' )
		->where('chamados.id','=', $request->get('id'))
		->first();
		
		return Response::json($chamado);
	}
	
	public function open( Request $request ){
		
		if( $request->has('f_email') && $request->has('f_pedidos_id') ){
			$chamados = Pedido::join('chamados', 'pedidos.id', '=' ,'chamados.pedido_id')
			->join('clientes','pedidos.cliente_id','=','clientes.id')
			->select( 'clientes.*', 'pedidos.*', 'chamados.*' )
			->where( 'clientes.id', '=', $request->f_email )
			->where( 'pedidos.id', '=', $request->f_pedidos_id )
			->orderBy('chamados.id', 'desc')
			->paginate( 5 );
		}
		
		else if( !$request->has('f_email') && $request->has('f_pedidos_id') ){
			$chamados = Pedido::join('chamados', 'pedidos.id', '=' ,'chamados.pedido_id')
			->join('clientes','pedidos.cliente_id','=','clientes.id')
			->select( 'clientes.*', 'pedidos.*', 'chamados.*' )
			->where( 'pedidos.id', '=', $request->f_pedidos_id )
			->orderBy('chamados.id', 'desc')
			->paginate( 5 );
		}
		
		else if( $request->has('f_email') && !$request->has('f_pedidos_id') ){
			$chamados = Pedido::join('chamados', 'pedidos.id', '=' ,'chamados.pedido_id')
			->join('clientes','pedidos.cliente_id','=','clientes.id')
			->select( 'clientes.*', 'pedidos.*', 'chamados.*' )
			->where( 'clientes.id', '=', $request->f_email )
			->orderBy('chamados.id', 'desc')
			->paginate( 5 );
		}
		else{
			$chamados = Pedido::join('chamados', 'pedidos.id', '=' ,'chamados.pedido_id')
			->join('clientes','pedidos.cliente_id','=','clientes.id')
			->select( 'clientes.*', 'pedidos.*', 'chamados.*' )
			->orderBy('chamados.id', 'desc')
			->paginate( 5 );
		}
		
		return view('relatorio')->with('chamados', $chamados );
	}
	

}
