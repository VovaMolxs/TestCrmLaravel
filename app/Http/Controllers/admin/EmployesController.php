<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployesRequest;
use App\Models\Companies;
use App\Models\Employes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EmployesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Companies::all();
        return view('admin.employes.index', compact('companies'));
    }

    public function getAll(Request $request) {
        if ($request->ajax()) {

            $data = Employes::getAll();

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($data) {
                    $button = '<button type="button" name="edit" id ="'.$data->id.'" class="edit btn btn-primary btn-sm" <i class="bi bi-pencil-square"></i>edit</button>';
                    $button .= '<button type="button" name="delete" id ="'.$data->id.'" class="delete btn btn-primary btn-sm" <i class="bi bi-pencil-square"></i>delete</button>';
                    return $button;
                })
                ->make(true);
        }

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
    public function store(EmployesRequest $request)
    {
        $data = $request->validated();

        Employes::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'note' => $data['note'],
            'companies_id' => $data['company_id']
        ]);
        return response()->json([
            'status' => 200
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $employ = Employes::find($id);
        return response()->json(['result' => $employ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployesRequest $request, string $id)
    {

        $data = $request->validated();

        Employes::find($id)->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'note' => $data['note'],
            'companies_id' => $data['company_id']
        ]);
        return response()->json([
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Employes::destroy($id);
        return response()->json([
            'status' => 200
        ]);
    }
}
