<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\modeles\medicament;

class MedicamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getmed($id)
    {
        $med = medicament::FindOrFail($id);
        return json_encode($med);
    }
    public function getmedicaments()
    {
        $medicaments = medicament::select(['id','Nom_com','Code_DCI','Forme','Dosage','Conditionnement']);
        // $x = Datatables::of($medicaments);
        // dd($x);
        return Datatables::of($medicaments)
            ->addColumn('action', function ($medicament) {
                return '<div class="hidden-sm hidden-xs btn-group">
                            <button class="btn btn-xs btn-primary"  
                            onclick="medicm('.$medicament->id.')">
                            <i class="ace-icon  fa fa-plus-circle"></i>
                            </button>';
                        //     </div><div class="hidden-sm hidden-xs btn-group">
                        //     <a href="#" class="btn btn-xs btn-success">
                        //         <i class="ace-icon fa fa-hand-o-up bigger-120"></i>
                        //     </a>
                        // </div>
            })
            ->make(true);
    }
}
