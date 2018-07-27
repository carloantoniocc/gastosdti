<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use GastosDTI\Factura;
use GastosDTI\Establecimiento;
use GastosDTI\Item;
use GastosDTI\TipoEstab;
use GastosDTI\Comuna;
use GastosDTI\User;
use GastosDTI\Provider;
use GastosDTI\Categorie;



class FacturaModuleTest extends TestCase
{

	use DatabaseTransactions;



    /**  @test  */
    function valida_ingreso_de_usuario()
    {


		//$this->startSession();
		
		$user = User::find(1);	
		//$this->asLoginUser($user);		

      	$this->call('post', '/login', [
             'email' => $user->email,
             'passowrd' =>$user->password, // <- it must not be encrypted
      	])->assertRedirect('/');

            
    }

    function valida_ingreso()
    {

		$user = User::find(1);	
		$this->actingAs($user)->assertRedirect('/');

            
    }


    /**  @test  */
    function crear_factura()
    {

		$user = User::find(1);	
		$this->actingAs($user);

    	$provider = Provider::find(1);
    	$categorie = Categorie::find(1);


        $this->post('/facturas/' , [

    		'provider_id' => $provider->id,
    		'categorie_id' => $categorie->id,
    		'numero' => '11222',
    		'fecha_recepcion' => '2017-01-01',
    		'fecha_vencimiento' => NULL,
    		'monto' => '500',
    		'montoresumen' => '500',
    		'notacredito' => '321321',
    		'orden_compra' => '22222',
    		'active' => 1,

        ])->assertRedirect('facturas');
            
    }



}
