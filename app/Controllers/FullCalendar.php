<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
 
class FullCalendar extends Controller
{
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index() {
 
        $db = \Config\Database::connect();
        $builder = $db->table('events');   
        $query = $builder->select('*')
                    ->limit(10)->get();
 
        $data = $query->getResult();
 
        foreach ($data as $key => $value) {
            $data['data'][$key]['title'] = $value->title;
            $data['data'][$key]['start'] = $value->start_date;
            $data['data'][$key]['end'] = $value->end_date;
            $data['data'][$key]['backgroundColor'] = "#00a65a";
        }        

        return view('home',$data);
    }
 
}