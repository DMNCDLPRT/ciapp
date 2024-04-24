<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $officeModel = new \App\Models\OfficeModel();
        $ticketModel = new \App\Models\TicketModel();

        $data['totaloffices'] = $officeModel->countAllResults();
        $data['totaltickets'] = $ticketModel->countAllResults();

        $data['totalopen'] = $ticketModel->where("state", "open")->countAllResults();
        $data['totalclosed'] = $ticketModel->where("state", "closed")->countAllResults();

        $data['donutchart'] = $ticketModel->select('offices.name as office_name, COUNT(tickets.id) as ticket_count')
            ->join('offices', 'offices.id = tickets.office_id', 'left')
            ->groupBy('offices.name')
            ->get()
            ->getResultArray();


        return view('pages/dashboard', $data);
    }
}
