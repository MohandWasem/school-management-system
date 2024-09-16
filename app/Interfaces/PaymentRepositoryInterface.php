<?php

namespace App\Interfaces;

interface PaymentRepositoryInterface 
{

    // get payment student 
    public function index();

    // show Payment student
    public function show($id);

    // store Payment student
    public function store($request);

    // edit Payment student
    public function edit($id);

    // update Payment student
    public function update($request);

    // destroy Payment student
    public function destroy($request);
}