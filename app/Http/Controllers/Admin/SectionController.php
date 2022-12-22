<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Session;

class SectionController extends Controller
{
    public function sections()
    {
        Session::put('page', 'sections');
        $sections = Section::all()->toArray();
        //dd($sections);
        return view('admin.sections.sections')->with(compact('sections'));
    }

    /**
     * 23 : Update section status
     */

    public function updatedSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;

            if ($data["status"] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Section::where('id', $data['section_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'section_id' => $data['section_id']]);

        }
    }

    public function deletesection($id)
    {

        //Delete Sections
        Section::where('id', $id)->delete();
        $message = "Section has been deleted successfully";
        return redirect()->back()->with('success_message', $message);
    }

    public function addEditSection(Request $request, $id = null)
    {
        Session::put('page', 'sections');

        if ($id == "") {
            $title = "Add Section";
            $section = new Section;
            $message = "Sections added successfully";
        } else {
            $title = "Edit Section";
            $section = Section::find($id);
            $message = "Sections updated successfully";
        }

        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'section_name' => 'required',
            ];

            $customMessages = [
                'section_name.required' => 'Section Name is required',
                // 'section_name.regex' => 'Section Name is not valid',

            ];
            $this->validate($request, $rules, $customMessages);

            $section->name = $data['section_name'];
            $section->status = 1;
            $section->save();

            return redirect('admin/sections')->with('success_message', $message);
        }

        return view('admin.sections.add_edit_section')->with(compact('title', 'section'));

    }
}
