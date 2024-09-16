<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use Livewire\Component;
use App\Models\MyParent;
use App\Models\Religion;
use App\Models\Nationality;
use Livewire\WithFileUploads;
use App\Models\ParentAttachmentt;
use Illuminate\Support\Facades\Storage;

class AddParent extends Component
{

    use WithFileUploads;

    public $currentStep = 1;
    public $successMessage = [];
    public $photos = [], $parent_id,$show_table= true,$updateMode=false;
    public $catchError;

    public 
    // father_inputs
    $Email,$Password,$Name_Father,
    $Name_Father_en,$Job_Father,$Job_Father_en,
    $National_ID_Father,$Passport_ID_Father,$Phone_Father,
    $Nationality_Father_id,$Blood_Type_Father_id,$Religion_Father_id,
    $Address_Father,

    // mother_inputs
    $Name_Mother,$Name_Mother_en,$Job_Mother,
    $Job_Mother_en,$National_ID_Mother,$Passport_ID_Mother,
    $Phone_Mother,$Nationality_Mother_id,$Blood_Type_Mother_id,
    $Religion_Mother_id,$Address_Mother;


    // --- validation-----\\
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'Email'=>'required|email',
            'National_ID_Father'=>'required|min:10|max:14|regex:/[0-9]{9}/|string',
            'Passport_ID_Father'=>'min:10|max:14',
            'Phone_Father'=>'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother'=>'required|min:10|max:14|regex:/[0-9]{9}/|string',
            'Passport_ID_Mother'=>'min:10|max:14',
            'Phone_Mother'=>'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent',[
            'Nationalities'=>Nationality::get(),
            'Type_Bloods'=>Blood::get(),
            'Religions'=>Religion::get(),
            'my_parents'=>MyParent::get(),
        ]);
    }

    // firstStepSubmit-----\\
    public function firstStepSubmit()
    {
        $this->validate(([
            'Email'=>'required|unique:my_parents,Email,'.$this->id,
            'Password'=>'required',
            'Name_Father'=>'required',
            'Name_Father_en'=>'required',
            'Job_Father'=>'required',
            'Job_Father_en'=>'required',
            'National_ID_Father'=>'required|unique:my_parents,National_ID_Father,'.$this->id,
            'Passport_ID_Father'=>'required|unique:my_parents,Passport_ID_Father,'.$this->id,
            'Phone_Father'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id'=>'required',
            'Blood_Type_Father_id'=>'required',
            'Religion_Father_id'=>'required',
            'Address_Father'=>'required',

        ]));
        $this->currentStep = 2;
    }

    // secondStepSubmit-----\\
    public function secondStepSubmit()
    {

        $this->validate(([
            'Name_Mother'=>'required',
            'Name_Mother_en'=>'required',
            'Job_Mother'=>'required',
            'Job_Mother_en'=>'required',
            'National_ID_Mother'=>'required|unique:my_parents,National_ID_Father,'.$this->id,
            'Passport_ID_Mother'=>'required|unique:my_parents,Passport_ID_Father,'.$this->id,
            'Phone_Mother'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Mother_id'=>'required',
            'Blood_Type_Mother_id'=>'required',
            'Religion_Mother_id'=>'required',
            'Address_Mother'=>'required',

        ]));

        $this->currentStep = 3;
    }

    // --------submitForm-----\\
    public function submitForm()
    {
        try {

        $My_Parent = new MyParent();
        // Father_INPUTS
        $My_Parent->email = $this->Email;
        $My_Parent->password = bcrypt($this->Password); // Hashing the password
        $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
        $My_Parent->National_ID_Father = $this->National_ID_Father;
        $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
        $My_Parent->Phone_Father = $this->Phone_Father;
        $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
        $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
        $My_Parent->Nationality_Father_id = $this->Nationality_Father_id;
        $My_Parent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
        $My_Parent->Religion_Father_id = $this->Religion_Father_id;
        $My_Parent->Address_Father = $this->Address_Father;

         // Mother_INPUTS
         $My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
         $My_Parent->National_ID_Mother = $this->National_ID_Mother;
         $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
         $My_Parent->Phone_Mother = $this->Phone_Mother;
         $My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
         $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
         $My_Parent->Nationality_Mother_id = $this->Nationality_Mother_id;
         $My_Parent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
         $My_Parent->Religion_Mother_id = $this->Religion_Mother_id;
         $My_Parent->Address_Mother = $this->Address_Mother;
         $My_Parent->save();

         if(!empty($this->photos)){
            foreach ($this->photos as $photo) {
                $photo->storeAs($this->National_ID_Father,$photo->getClientOriginalName(), 
                $disk = 'parent_attachments');
                ParentAttachmentt::create([
                    'file_name'=>$photo->getClientOriginalName(),
                    'parent_id'=>MyParent::latest()->first()->id,
                ]);
            }
         }

         $this->successMessage = trans('messages.Success');
         $this->clearForm();
         $this->currentStep = 1;


        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
            $this->currentStep = 1;
        }
    }


    // ------------ edit -----\\
    public function edit($id) //اللي بيفتح فورم التعديل
    {
        $this->updateMode = true;  //فعل وضع التعديل
        $this->show_table = false;  //اخفي الجدول وافتح الفورم
        $My_Parent = MyParent::where('id',$id)->first(); //املى بيانات الفورم
        $this->parent_id = $id;
        $this->Email = $My_Parent->email;
        $this->Password = $My_Parent->password;
        $this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('Job_Father', 'en');
        $this->National_ID_Father =$My_Parent->National_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Passport_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->Nationality_Father_id;
        $this->Blood_Type_Father_id = $My_Parent->Blood_Type_Father_id;
        $this->Address_Father =$My_Parent->Address_Father;
        $this->Religion_Father_id =$My_Parent->Religion_Father_id;

        // ------------ Mother -----\\
        $this->Name_Mother = $My_Parent->getTranslation('Name_Mother', 'ar');
        $this->Name_Mother_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Mother = $My_Parent->getTranslation('Job_Mother', 'ar');;
        $this->Job_Mother_en = $My_Parent->getTranslation('Job_Mother', 'en');
        $this->National_ID_Mother =$My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Passport_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->Nationality_Mother_id;
        $this->Blood_Type_Mother_id = $My_Parent->Blood_Type_Mother_id;
        $this->Address_Mother =$My_Parent->Address_Mother;
        $this->Religion_Mother_id =$My_Parent->Religion_Mother_id;
    }

    // ------------ firstStepSubmit_edit -----\\
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }

    // ------------ secondStepSubmit_edit -----\\
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }

    public function submitForm_edit()
    {
       try {
        if($this->parent_id){
            $My_Parent = MyParent::findOrFail($this->parent_id);
            $My_Parent->update([
                'email' => $this->Email,
                'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'Name_Mother' => ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother],
                'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'Job_Mother' => ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother],
                'National_ID_Father' => $this->National_ID_Father,
                'Passport_ID_Father' => $this->Passport_ID_Father,
                'Phone_Father' => $this->Phone_Father,
                'Nationality_Father_id' => $this->Nationality_Father_id,
                'Blood_Type_Father_id' => $this->Blood_Type_Father_id,
                'Religion_Father_id' => $this->Religion_Father_id,
                'Address_Father' => $this->Address_Father,
                'National_ID_Mother' => $this->National_ID_Mother,
                'Passport_ID_Mother' => $this->Passport_ID_Mother,
                'Phone_Mother' => $this->Phone_Mother,
                'Nationality_Mother_id' => $this->Nationality_Mother_id,
                'Blood_Type_Mother_id' => $this->Blood_Type_Mother_id,
                'Religion_Mother_id' => $this->Religion_Mother_id,
                'Address_Mother' => $this->Address_Mother,
            ]);

            $this->successMessage = trans('messages.Success');
            $this->updateMode = false;
            $this->show_table = true;
        }else {
            $this->catchError = "Parent ID is not set.";
        }
       } catch (\Exception $e) {
          $this->catchError = $e->getMessage();
       }
    }

    public function delete($id)
    {
        $My_Parent = MyParent::findOrFail($id);
         $parent_attechments = ParentAttachmentt::where('parent_id',$My_Parent->id)->get();
        
        if($parent_attechments->isNotEmpty()){
            foreach ($parent_attechments as $parent_attechment ) {
                Storage::disk('parent_attachments')->delete($parent_attechment->file_name);
            }
            ParentAttachmentt::where('parent_id',$My_Parent->id)->delete();
        }
        $My_Parent->delete();
        // return redirect()->to('add_parent');
        $this->successMessage = trans('messages.Delete');
    }


    // ------------ clearForm -----\\
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father ='';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father ='';
        $this->Religion_Father_id ='';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother ='';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother ='';
        $this->Religion_Mother_id ='';

    }

    public function showformadd()
    {
        $this->show_table = false;
    }

    public function showtable()
    {
        $this->show_table = true;

    }

    // ------------back-----\\
    public function back($step)
    {
        $this->currentStep = $step;
    }

}
