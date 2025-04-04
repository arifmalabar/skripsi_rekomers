<?php

namespace App\Http\Controllers\Headmaster\ProgramStudy;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Headmaster\BaseHeadmasterController;
use App\Models\Headmaster\ProgramStudy;
use Illuminate\Http\Request;

class ProgramStudyController extends BaseHeadmasterController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path."/jurusan/jurusan", ["nama" => "jurusan"]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Headmaster\ProgramStudy  $programStudy
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramStudy $programStudy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Headmaster\ProgramStudy  $programStudy
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramStudy $programStudy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Headmaster\ProgramStudy  $programStudy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgramStudy $programStudy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Headmaster\ProgramStudy  $programStudy
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramStudy $programStudy)
    {
        //
    }
}
