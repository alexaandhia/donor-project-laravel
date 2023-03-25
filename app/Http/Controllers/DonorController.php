<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\Response;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use PDF;
use Excel;
use App\Exports\DonorsExport;


class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donors = Donor::orderBy('created_at', 'DESC')->simplePaginate(10);
        return view('landpage', compact('donors'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric' ,
            'age' => 'required|numeric',
            'weight' => 'required',
            'type' => 'required',
            'email' =>'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png,svg,jfif',
        ]);

        //tambah foto ke public
        $image = $request->file('foto');
        $imgName = rand() . '.' . $image->extension(); 
        $path = public_path('assets/image/');
        $image->move($path, $imgName);

        Donor::create([
            'name'=> $request->name,
            'phone'=> $request->phone,
            'age'=> $request->age,
            'weight'=> $request->weight,
            'type'=> $request->type,
            'email'=> $request->email,
            'foto' => $imgName,
        ]);

        return redirect()->back()->with('success', 'register succeed!');


    }

    public function login(){
        return view('login');
    }

    public function auth(Request $request){
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $user = $request->only('email', 'password');
        if (Auth::attempt($user)){
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin');
            }elseif(Auth::user()->role == 'officer'){
                return redirect()->route('officer');
            }
         }else{
             return redirect()->back()->with('errorLogin', 'login gagal, silahkan coba lagi');  
         }
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('successLogout', 'Logout Succeed');
    }

    public function admin(Request $request){
        $search = $request->search;
        $donors = Donor::where('name', 'LIKE', '%' . $search . '%')->simplePaginate(5);
        return view('admin', compact('donors'));
    }

    public function exportPDF(){
        $data = Donor::with('response')->get()->toArray();
        view()->share('donor', $data);
        $pdf = PDF::loadView('print', $data)->setPaper('a4', 'landscape');
        return $pdf->download('donors_data.pdf'); 
    }

    public function createPDF($id){
        $data = Donor::with('response')->where('id', $id)->get()->toArray();
        view()->share('donor', $data);
        $pdf = PDF::loadView('print', $data);
        return $pdf->download('WH_donor.pdf');
    }
    

    public function exportExcel(){
        $file_name = 'donors_data.xlsx';
        return Excel::download(new DonorsExport, $file_name);
    }

    public function officer(Request $request){
        $search = $request->search;
        $donors = Donor::where('name', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'ASC')->simplePaginate(5);
        return view('officer', compact('donors'));


    }

    public function response(){
        return view('response');
    }

    public function error(){
        return view('error');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donor $donor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donor $donor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donor $donor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Donor::where('id', $id)->firstOrFail();
        unlink('assets/image/'.$data['foto']);
        $data->delete();
        Response::where('donor_id', $id)->delete();
        return redirect()->back()->with('successDelete', 'delete succeed!');
    }
}
