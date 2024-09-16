<?php

namespace App\Interfaces;

interface SubjectRepositoryInterface 
{

    // get Material
    public function index();

    // add Material
    public function add();

    // store Material
    public function store($request);

    // edit Material
    public function edit($id);

    // update Material
    public function update($request);

    // delete Material
    public function destroy($request);

}