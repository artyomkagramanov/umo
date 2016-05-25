<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Contracts\CalculateServiceInterface;

class CalculateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index(CalculateServiceInterface $calculateService)
    {
        $res = $calculateService->getAll();
        return response()->json(['status' => 'success', 'resource' => $res]);
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
    public function store(Request $request, CalculateServiceInterface $calculateService)
    {
        if($calculateService->create($request->all())) {
            return response()->json(['status' => 'success', 'resource' => $calculateService->getAll()]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, CalculateServiceInterface $calculateService)
    {
        return response()->json(['status' => 'success', 'resource' => $calculateService->getById($id)]);
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
    public function update(Request $request, $id, CalculateServiceInterface $calculateService)
    {
        if($calculateService->update($id, $request->all())) {
            return response()->json(['status' => 'success', 'resource' => $calculateService->getAll()]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CalculateServiceInterface $calculateService)
    {
        if($calculateService->destroy($id)) {
            return response()->json(['status' => 'success', 'resource' => $calculateService->getAll()]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error']);
    }
}
