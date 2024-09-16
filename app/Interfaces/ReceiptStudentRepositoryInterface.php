<?php

namespace App\Interfaces;

interface ReceiptStudentRepositoryInterface 
{

    // get receipt students 
    public function index();

    // get student_id to add receipt 
    public function show($id);

    // add student_id to add receipt 
    public function add($request);

    // edit student_id to edit receipt 
    public function edit($id);

    // update student_id to update receipt 
    public function update($request);

    // destroy student_id to destroy receipt 
    public function destroy($request);

}