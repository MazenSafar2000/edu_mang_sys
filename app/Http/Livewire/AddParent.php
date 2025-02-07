<?php

namespace App\Http\Livewire;

use App\Models\My_Parent;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;

    public $successMessage = '';

    public $catchError, $updateMode = false, $photos, $show_table = true, $Parent_id;

    public $currentStep = 1,

        // Father_INPUTS
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Address_Father;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent', [
            'my_parents' => My_Parent::all(),
        ]);
    }

    public function showformadd()
    {
        $this->show_table = false;
    }



    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'Email' => 'required|unique:my__parents,Email,' . $this->id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Address_Father' => 'required',
        ]);

        $this->submitForm();
    }


    public function submitForm()
    {

        try {
            $My_Parent = new My_Parent();
            // Father_INPUTS
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->Address_Father = $this->Address_Father;
            $My_Parent->save();

            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }


    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $My_Parent = My_Parent::where('id', $id)->first();
        $this->Parent_id = $id;
        $this->Email = $My_Parent->Email;
        $this->Password = $My_Parent->Password;
        $this->Name_Father = $My_Parent->getTranslation('Name_Father', 'ar');
        $this->Name_Father_en = $My_Parent->getTranslation('Name_Father', 'en');
        $this->Job_Father = $My_Parent->getTranslation('Job_Father', 'ar');;
        $this->Job_Father_en = $My_Parent->getTranslation('Job_Father', 'en');
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Address_Father = $My_Parent->Address_Father;
    }

    //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }

    public function submitForm_edit()
    {

        if ($this->Parent_id) {
            $parent = My_Parent::find($this->Parent_id);
            $parent->update([
                'Email' => $this->Email,
                'Password' => Hash::make($this->Password),
                'Name_Father' => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'Job_Father' => ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father],
                'Phone_Father' => $this->Phone_Father,
                'Address_Father' => $this->Address_Father,
            ]);
        }

        return redirect()->to('/add_parent');
    }

    public function delete($id)
    {
        My_Parent::findOrFail($id)->delete();
        return redirect()->to('/add_parent');
    }


    //clearForm
    public function clearForm()
    {
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Name_Father_en = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Phone_Father = '';
        $this->Address_Father = '';
    }


    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }
}
