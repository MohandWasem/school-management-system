<?php

namespace App\Interfaces;

interface GraduatedRepositoryInterface 
{

    // index Graduated Student
    public function index();

    // create Graduated Student
    public function create();

    // create Graduated Student to softDelete
    public function softDelete($request);

    // return  Graduated Student from softDelete
    public function returnStudent($request);

    // forcedelete  Graduated Student from database 
    public function destroy($request);
}