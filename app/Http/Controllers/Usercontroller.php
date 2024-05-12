<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\CustomerExport;
use App\Imports\CustomerImport;
use vaildate;
use Maatwebsite\Excel\Facades\Excel;

class Usercontroller extends Controller
{
    // excel logic

    public function import()
    {
        $users = User::where('is_active', 1)->get();
        return view('user.import', compact('users'));
    }

    public function importExcel(Request $request)
    {

        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new CustomerImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Imported Successfully');


        // return view('user.import');
    }


    public function export(Request $request)

    {
        // dd($request);
        if ($request->type == "xlsx") {
            $ext = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $ext = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $ext = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $ext = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }

        $filename = 'customer-' . date('d-m-Y') . '.' . $ext;
        return Excel::download(new CustomerExport, $filename, $exportFormat);
    }
    public function index()
    {

        $users = User::where('is_active', 1)->get();
        // echo $users;exit();
        return view('user.index', compact('users'));
    }



    //curd logic
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $usermobile = User::where('mobile',$request->mobile)->count();
        $useremail = User::where('email',$request->email)->count();
        // dd($usermobile);
        if($usermobile > 0){
            return redirect()->route('list')->with('status', 'Customer Mobile Already Exits');
        }elseif($useremail > 0){
            return redirect()->route('list')->with('status', 'Customer  Email Already Exits');

        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users|max:255',
            'mobile' => 'required',
            'address' => 'required'
        ]);
        $User = new User();
        $User->name = $request->name;
        $User->email = $request->email;
        $User->mobile = $request->mobile;
        $User->address = $request->address;
        if ($User->save()) {
            return redirect()->route('list')->with('status', 'Customer Created successfully.');
        }
    }


    public function edit(string $id)
    {
        // dd($id);
        $users = User::findOrFail($id);
        // dd($users);
        return view('user.edit', compact('users'));
    }


    public function update(Request $request, string $id)
    {
        // dd($id);
        // dd($request); ,'id !=', $id
        // 'Users.id !=' => $id ,'id !=', $id
        $usermobile = User::where('mobile',$request->mobile)
                    ->where('id', '!=', $id)->count();
        // dd(count($usermobile));

        $useremail = User::where('email',$request->email)
                    ->where('id', '!=', $id)->count();
        // dd($usermobile);
        if($usermobile > 0){
            return redirect()->route('list')->with('status', 'Customer Mobile Already Exits');
        }elseif($useremail){
            return redirect()->route('list')->with('status', 'Customer Email Already Exits');

        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'mobile' => 'required',
            'address' => 'required',
        ]);

        // Find the user
        $User = User::findOrFail($id);
        // dd($User);
        // Update the User with the request data
        $User->name = $request->name;
        $User->email = $request->email;
        $User->mobile = $request->mobile;
        $User->address = $request->address;
        $User->save();

        // Redirect with success message
        return redirect()->route('list')->with('status', 'Customer updated successfully.');
    }


    public function delete($id)
    {

        // dd($id);
        $User = User::findOrFail($id);
        $User->is_active = 0;

        $User->save();

        // Redirect with success message
        return redirect()->route('list')->with('status', 'Customer deleted successfully.');
    }

    public function list()
    {
        $users = User::where('is_active', 1)->get();
        // echo $users;exit();
        return view('user.list', compact('users'));
    }
}
