<?php

namespace App\Interfaces;

interface TeacherRepositoryInterface 
{

    // get all Teachers 
    public function getAllTeachers();

    // insert  Teachers 
    public function insertTeachers();

    // store  Teachers 
    public function storeTeachers($request);

    // Edit  Teachers 
    public function EditTeachers($id);

    // Update  Teachers 
    public function UpdateTeachers($request);

    // Delete  Teachers 
    public function DeleteTeachers($request);
}