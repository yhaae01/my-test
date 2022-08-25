<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Http\Requests\EmployeRequest;
use App\Models\Company;
use Yajra\DataTables\Facades\DataTables;


class EmployeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        $employes = Employe::all();

        return view('admin.employe', compact('companies', 'employes'));
    }

    public function api()
    {
        if (request()->ajax()) 
        {
            $query = Employe::with(['company'])->get();

            return Datatables::of($query)
                ->addIndexColumn()
                ->make();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeRequest $request)
    {
        $data = $request->all();
        Employe::create($data);

        return redirect()->route('employe.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeRequest $request, $id)
    {
        $data = $request->all();

        $item = Employe::findOrFail($id);

        $item->update($data);

        return redirect()->route('employe.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Employe::findorFail($id);
        $item->delete();

        return redirect()->route('employe.index');
    }
}
