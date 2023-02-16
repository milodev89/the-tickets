<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Ticket;
use App\Interfaces\TicketRepositoryInterface;

class TicketController extends Controller
{
    private TicketRepositoryInterface $ticketRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TicketRepositoryInterface $ticketRepository) 
    {
        $this->ticketRepository = $ticketRepository;
        $this->middleware('auth', ['except' => ['index', 'show_tickets']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('welcome', ['tickets' => $this->ticketRepository->getAllTickets()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return View('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show_tickets(Request $request)
    {
        return response()->json($this->ticketRepository->getTicketsByUserId($request->user_id, $request->limit, $request->q));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show_ticket(Request $request)
    {
        return response()->json($this->ticketRepository->getTicketById($request->ticket_id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->ticketRepository->createTicket($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return response()->json($this->ticketRepository->updateTicket($request->id, $request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return response()->json($this->ticketRepository->deleteTicket($request->id));
    }
}
