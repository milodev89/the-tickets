<?php

namespace App\Interfaces;

interface TicketRepositoryInterface 
{
    public function getAllTickets();
    public function getTicketById($ticketId);
    public function getTicketsByUserId($ticketId, $limit, $q);
    public function deleteTicket($ticketId);
    public function createTicket(array $ticketDetails);
    public function updateTicket($ticketId, array $newDetails);
}