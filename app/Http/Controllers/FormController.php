<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Form;
use App\Models\FormField;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{

    public function index(){
        $forms = Form::where('status', '>=', 0)->with('user')->latest()->paginate(10);
        return view('forms.index', ['forms' => $forms]);
    }
    public function create(){
        return view('forms.form', ['form' => new Form]);
    }
    public function update(Form $form){
        if(!$form){
            return response('', 404);
        }
        $fields = $form->fields()->get();
        return view('forms.form', ['form' => $form, 'fields' => $fields]);
    }

    public function do_create(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:160',
            'description' => 'nullable|max:255'
        ]);
        $user = Auth::user();
        $form = new Form;
        $form->user_id = $user->id;
        $form->name = $request->name;
        $form->description = $request->description;
        $result = $form->save();
        if(!$result){
            return redirect()->back()->withInput()->with('error', 'Unable to create the form!');
        }
        return redirect()->route('forms.update', ['form' => $form->id])->with('success', 'Form created successfully!');
    }

    public function do_update(Request $request, Form $form){
        if(!$form){
            return response('', 404);
        }
        $request->validate([
            'name' => 'required|min:3|max:160',
            'description' => 'nullable|max:255'
        ]);
        $user = Auth::user();
        $form->user_id = $user->id;
        $form->name = $request->name;
        $form->description = $request->description;
        if($request->disabled){
            $form->status = 0;
        }else{
            $form->status = 1;
        }
        $result = $form->save();
        if(!$result){
            return redirect()->back()->withInput()->with('error', 'Unable to update the form!');
        }
        return redirect()->back()->with('success', 'Form updated successfully!');
    }

    public function do_delete(Form $form){
        if(!$form){
            return response('', 404);
        }
        $form->status = -1;
        $result = $form->save();
        if(!$result){
            return redirect()->back()->withInput()->with('error', 'Unable to delete the form!');
        }
        return redirect()->back()->with('success', 'Form deleted successfully!');
    }


    public function do_add_field(Request $request, Form $form){
        if(!$form){
            return response('', 404);
        }
        $request->validate([
            'field_name' => 'required|min:3|max:25',
            'required' => 'nullable|numeric',
            'unique' => 'nullable|numeric'
        ]);

        $field = Field::where('name', $request->field_name)->where('status', '>', 0)->first();

        if(!$field){
            return redirect()->back()->withInput()->with('error', 'Fiend name not found!');
        }

        $form->fields()->attach(['field_id' => $field->id],
        [
            'is_required' => $request->required ? true : false,
            'is_unique' => $request->unique ? true : false
        ]);
        return redirect()->back()->with('success', 'Filed added to the form successfully.');
    }

    public function do_remove_field(Form $form, Field $field){
        if(!$form || !$field){
            return response('', 404);
        }
        $result = FormField::where('form_id', $form->id)->where('field_id', $field->id)->delete();
        if(!$result){
            return redirect()->back()->with('error', 'Unable to remove the field!');
        }
        return redirect()->back()->with('success', 'Field removed successfully!');
    }
}
