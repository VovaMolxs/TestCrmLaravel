<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompaniesRequest;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Yajra\DataTables\DataTables;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.companies.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    public function getAll(Request $request) {
        if ($request->ajax()) {
            $data = Companies::select('id','name', 'logo', 'email', 'phone', 'note', 'website')->get();

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($data) {
                    $button = '<button type="button" name="edit" id ="'.$data->id.'" class="edit btn btn-outline-primary btn-sm mr-2" <i class="bi bi-pencil-square"></i>edit</button>';
                    $button .= '<button type="button" name="delete" id ="'.$data->id.'" class="delete btn btn-outline-danger btn-sm" <i class="bi bi-pencil-square"></i>delete</button>';
                    return $button;
                })
                ->make(true);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompaniesRequest $request)
    {

        $data = $request->validated();

        $data['logo'] = Storage::putFile('/file', $data['logo']);

        Companies::create($data);
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
        $company = Companies::find($id);
        return response()->json(['result' => $company]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompaniesRequest $request, $id)
    {
        dd($request->all());
        $data = $request->validated();

        Companies::find($id)->update($data);
        return response()->json([
            'status' => 200
        ]);
    }

    public function update2(CompaniesRequest $request, $id) {

        $data = $request->validated();
        $data['logo'] = Storage::putFile('/file', $data['logo']);

        Companies::find($id)->update($data);
        return response()->json([
            'status' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        Companies::destroy($id);
        return response()->json([
            'status' => 200
        ]);
    }
}
