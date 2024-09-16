<?php

namespace App\Interfaces;

interface FeesRepositoryInterface 
{

    // index  fees
    public function index();

    // create fees
    public function create();

    // store fees
    public function store($request);

    // edit fees
    public function edit($id);

    // update fees
    public function update($request);

    // destroy fees
    public function destroy($request);

}