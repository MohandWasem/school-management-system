<?php

namespace App\Interfaces;

interface FeesInvoiceRepositoryInterface 
{

    // index  fees
    public function index();

    // create fees
    public function show($id);

    // store fees
    public function store($request);

    // edit fees
    public function edit($id);

    // update fees
    public function update($request);

    // destroy fees
    public function destroy($request);

}