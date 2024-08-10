<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{

    public function index(){
        $forms = Form::where('status', '>=', 0)->latest()->paginate(10);
        return view('forms.index', ['forms' => $forms]);
    }
    public function create(){
        return view('forms.form', ['form' => new Form]);
    }
    public function update(Form $form){
        if(!$form){
            return response('', 404);
        }
        return view('forms.form', ['form' => $form]);
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
        return redirect()->back()->with('success', 'Form created successfully!');
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
}
