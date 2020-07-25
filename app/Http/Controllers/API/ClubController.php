<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Club;
use App\Http\Requests\ClubRequest;
use Exception;
use App\Http\Resources\Club as ClubResource;
use App\Http\Resources\ClubCollection;

class ClubController extends Controller
{
    /**
     * @var \App\Models\Club
     */
    protected $model;

    public function __construct(Club $club)
    {
        $this->model = $club;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Club $club)
    {
        try {
            $clubs = $club->all();
            $clubsCollection = new ClubCollection($clubs);

            return response()->json($clubsCollection, 200);

        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno no servidor'
            ], 500);
        }
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
     * @param  \App\Http\Requests\ClubRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClubRequest $request)
    {
        try {
            $club = new Club();
            $club->fill($request->all());
            $club->save();
            $clubResource = new ClubResource($club);

            return response()->json($clubResource, 201);
        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $club = $this->model->findOrFail($id);
            $clubResource = new ClubResource($club);
            return response()->json($clubResource);

        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Aviso',
                'msg'   => 'Clube não encontrado!'
            ], 404);
        }
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
    public function update(ClubRequest $request, $id)
    {
        try {
            $club = $this->model->find($id);
            $club->fill($request->all());
            $club->save();
            $clubResource = new ClubResource($club);

            return response()->json($clubResource, 200);
        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $club = $this->model->find($id);
            if($club != null) {
                $club->delete();
                return response()->json([
                'msg' => 'Clube deletado com sucesso!'
            ], 200);
            } else {
                return response()->json([
                    'msg' => 'Clube não encontrado!'
                 ], 404);
            }
        } catch(\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg'   => 'Erro interno do servidor'
            ], 500);
        }
    }
}
