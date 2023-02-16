<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Interfaces\TicketRepositoryInterface;
use App\Models\Ticket;

class TicketRepository implements TicketRepositoryInterface 
{
    public function getAllTickets() 
    {
        $tickets = Ticket::select('id', 'name', 'status', 'user_id', 'created_at')->get();
    }

    public function getTicketById($ticketId) 
    {
        return Ticket::findOrFail($ticketId, ['id', 'name', 'status', 'user_id']);
    } 

    public function getTicketsByUserId($userId, $limit = 10, $q = '') 
    {
        $tickets = Ticket::orderBy('id', 'DESC');
        if(!empty($userId)){
            $tickets->whereUserId($userId);
        }
        
        if(!empty($q)){
            $tickets->where(function($subquery)use($q){
                $subquery->where('name', 'LIKE', '%'.$q.'%');
                $subquery->orwhere('status', 'LIKE', '%'.$q.'%');
            });
        }
        $tickets = $tickets->paginate($limit);

        return [
            'paginate' => [
                'total' => $tickets->total(),
                'current_page' => $tickets->currentPage(),
                'per_page' => $tickets->perPage(),
                'last_page' => $tickets->lastPage(),
                'from' => $tickets->firstItem(),
                'to' => $tickets->lastItem(),
            ],
            'tickets' => $tickets
        ];
    }     

    public function getTicketByUuid($ticketId) 
    {
        return Ticket::where('uuid', hex2bin($ticketId))->first();
    }

    public function deleteTicket($ticketId) 
    {
        Ticket::destroy($ticketId);
    }

    public function createTicket(array $ticketDetails) 
    {
        $ticketDetails['user_id'] = Auth::user()->id;
        $ticketDetails['uuid'] = str_replace('-', '', Str::uuid()->toString());
        return Ticket::create($ticketDetails);
    }

    public function updateTicket($ticketId, array $newDetails) 
    {
        if($newDetails['user_name']) unset($newDetails['user_name']);
        if($newDetails['user']) unset($newDetails['user']);
        return Ticket::whereId($ticketId)->update($newDetails);
    }
}