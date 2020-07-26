<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coach;
use App\Http\Requests\CoachRequest;
use Exception;
use App\Http\Resources\Coach as CoachResource;
use App\Http\Resources\CoachCollection;

class CoachController extends Controller
{
    /**
     * @var \App\Models\Coach
     */
    protected $model;

    public function __construct(Coach $coach)
    {
        $this->model = $coach;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Coach $coach)
    {
        try {
            $coaches = $coach->all();
            $coachesCollection = new CoachCollection($coaches);

            return response()->json($coachesCollection, 200);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoachRequest $request)
    {
        try {
            $coach = new Coach();
            $coach->fill($request->all());
            $coach->save();
            $coachResource = new CoachResource($coach);

            return response()->json($coachResource, 201);
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
            $coach = $this->model->findOrFail($id);
            $coachResource = new CoachResource($coach);
            return response()->json($coachResource);

        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Aviso',
                'msg'   => 'Treinador não encontrado!'
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
    public function update(CoachRequest $request, $id)
    {
        try {
            $coach = $this->model->find($id);
            $coach->fill($request->all());
            $coach->save();
            $coachResource = new CoachResource($coach);

            return response()->json($coachResource, 200);
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
            $coach = $this->model->find($id);
            if($coach != null) {
                $coach->delete();
                return response()->json([
                'msg' => 'Treinador deletado com sucesso!'
            ], 200);
            } else {
                return response()->json([
                    'msg' => 'Treinador não encontrado!'
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
