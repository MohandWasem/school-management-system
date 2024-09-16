<?php

namespace App\Interfaces;

interface StudentRepositoryInterface 
{
    // get add form student
    public function CreateStudent();

    // get  Classrooms
    public function getClassrooms($Grade_id);

    // get  Sections
    public function getSections($Classroom_id);

    // Store  Student
    public function storeStudent($request);

    // edit  Student
    public function editStudent($id);

    // show  Student
    public function showStudent($id);

    // update  Student
    public function updateStudent($request);

    // delete  Student
    public function deleteStudent($request);

    // get  Student
    public function getStudent();

    // Upload_attachment
    public function Upload_attachment($request);

    // Open_attachment
    public function Open_attachment($studentsname, $filename);

    // Download_attachment
    public function Download_attachment($studentname,$filename);

    // Delete_attachment
    public function Delete_attachment($request);


}