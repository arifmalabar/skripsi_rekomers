<?php

namespace App\Http\Controllers\Headmaster\Semester;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Headmaster\Semesters;
use Illuminate\Http\Request;

class SemesterController extends BaseController
{
    public function __construct() {
        $this->model = new Semesters();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Semesters  $semesters
     * @return \Illuminate\Http\Response
     */
    public function show(Semesters $semesters)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Semesters  $semesters
     * @return \Illuminate\Http\Response
     */
    public function edit(Semesters $semesters)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Semesters  $semesters
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semesters $semesters)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Semesters  $semesters
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semesters $semesters)
    {
        //
    }
}
