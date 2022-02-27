<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\modeles\ticket;
use App\modeles\Etablissement;
use PDF;
use BigFish\PDF417\PDF417;
use BigFish\PDF417\Renderers\ImageRenderer;
use BigFish\PDF417\Renderers\SvgRenderer;
use Carbon\Carbon;
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
    public function create()   {   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function store(Request $request)
      {
        if($request->ajax())  
        {
          $date = Date::Now()->toDateString();
          $datea = Date::Now();
          if($request->typecons == "Normale")
          {
               $tickets = ticket::where("date", $date)
                              ->where("specialite",$request->specialite)
                              ->get()->count();
                $ticket = ticket::firstOrCreate([
                      "date" => $datea,
                      "specialite" => $request->specialite,
                      "type_consultation" => $request->typecons,
                      "document" => $request->document,
                      "num_order" => ($tickets+1),
                      "id_patient" => $request->id_patient,
                ]);
          }else
          {
                $tickets = ticket::where("date", $date)
                                ->where("type_consultation",$request->typecons)
                                ->get()->count();
                $ticket = ticket::firstOrCreate([
                             "date" => $datea,
                              "specialite" => $request->specialite,
                              "type_consultation" => $request->typecons,
                             "document" => $request->document,
                               "num_order" => ($tickets+1),
                              "id_patient" => $request->id_patient,
                 ]);
          }
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
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function ticketPdf($id)
      {
        $ticket = ticket::with('Patient')->FindOrFail($id);
        $etablissement = Etablissement::first();
        $pdf = PDF::loadView('ticketPDF', compact('ticket','etablissement'))->setPaper('a6','landscape');
        $name = "Ticket-".$ticket->Patient->Nom."-".$ticket->Patient->Prenom.".pdf";
        return $pdf->download($name);
      }
}
