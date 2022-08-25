<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
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
        return view('admin.company');
    }

    public function api()
    {
        if (request()->ajax()) 
        {
            $query = Company::all();

            return Datatables::of($query)
                ->editColumn('logo', function($item) {
                    return $item->logo ? '<img src="'. Storage::url($item->logo) .'" style="max-height: 80px;" />' : '';
                })
                ->addIndexColumn()
                ->rawColumns(['logo'])
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
    public function store(CompanyRequest $request)
    {
        $data = $request->all();
        $data['logo'] = $request->file('logo')->store('/logo', 'public');
        Company::create($data);

        return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $item = Company::findOrFail($id);
        $data = $request->all();
        $data['logo'] = $request->file('logo')->store('/logo', 'public');

        $item->update($data);

        return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Company::findorFail($id);

        $storePath = storage_path('app/public/'.$item->logo); 
        if (file_exists($storePath)) {
            Storage::disk('public')->delete($item->logo);
        }
        $item->delete();

        return redirect()->route('company.index');
    }
}
