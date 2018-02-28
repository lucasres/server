<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Posicoes;
use App\User;
use App\Calc;
use App\Object;


class ApiController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Posicoes::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Posicoes::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Autenticar usuario
     *
     * @param  request $request
     * @return \Illuminate\Http\Response
     */

    public function authenticate(Request $request){
        if (Auth::attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
            // Authentication passed...
            return Auth::user();
        } else {
            return "no";
        }
    }

    /**
     * Cadastrar um novo usuario
     *
     * @param  request $request
     * @return \Illuminate\Http\Response
     */
    public function singup(Request $request){
        $data = [
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => Hash::make($request->input("password")),
        ];
        return User::create($data);
    }

    /**
     * Pegar a distancia de todos os objetos
     *
     * @param  request $request
     * @return \Illuminate\Http\Response
     */
    public function shorterDistance(Request $request){
        
        //variaveis auxiliares
        $aux = [];
        $objects = Object::all()->toArray();

        $menorDist =99999;
        $rs = null;

        foreach($objects as $object){
            //variaveis para ajudar no calculo
            $center_lat = $object['latitude'];
            $center_lng = $object['longitude'];
            $lat = $request->input("latitude");
            $lng = $request->input("longitude");
            //chamada do calculo
            $distancia = Calc::haversineGreatCircleDistance($center_lat, $center_lng, $lat, $lng, 6371);
            //convertendo em m
            $distancia = $distancia*1000;
            
            //conferindo se a distancia atual eh menor que a menor distancia gravada
            if($distancia<$menorDist){
                $menorDist = $distancia;
                $rs = $object;
            }
            
            
        }
        //retorna o menor
        return ($rs);
    }
}
