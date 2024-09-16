<?php

namespace App\Interfaces;

interface ProcessingFeeRepositoryInterface 
{

    // index ProcessingFee
    public function index();

    // show ProcessingFee
    public function show($id);

    // create ProcessingFee
    public function create($request);

    // edit ProcessingFee
    public function edit($id);

    // update ProcessingFee
    public function update($request);

    // destroy ProcessingFee
    public function destroy($request);

}