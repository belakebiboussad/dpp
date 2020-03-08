<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\modeles\ticket;
use PDF;

class ticketController extends Controller
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
        $date = Date::Now()->toDateString();
        $datea = Date::Now();
        if($request->typecons == "Normale")
        {
            $tickets = ticket::where("date", $date)
                            ->where("specialite",$request->spesialite)
                            ->get()->count();
            $ticket = ticket::firstOrCreate([
                "date" => $datea,
                "specialite" => $request->spesialite,
                "type_consultation" => $request->typecons,
                "document" => $request->document,
                "num_order" => ($tickets+1),
                "id_patient" => $request->id_patient,
            ]);
            // dd($ticket);
           
            return redirect()->route("ticket.pdf",$ticket->id);
        }
        else
        {
           $tickets = ticket::where("date", $date)
                            ->where("type_consultation",$request->typecons)
                            ->get()->count();
            $ticket = ticket::firstOrCreate([
                "date" => $datea,
                "specialite" => $request->spesialite,
                "type_consultation" => $request->typecons,
                "document" => $request->document,
                "num_order" => ($tickets+1),
                "id_patient" => $request->id_patient,
            ]);
            return redirect()->route("ticket.pdf",$ticket->id);
        }
    }
// comment
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
    public function ticketPdf($id)
    {
        $ticket = ticket::FindOrFail($id);
        $pdf = PDF::loadView('ticket', compact('ticket'))->setPaper('a6','landscape');
        $name = "Ticket.pdf";
        return $pdf->download($name);
    }
}
