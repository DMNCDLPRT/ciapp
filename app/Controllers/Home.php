<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
 
        $db = \Config\Database::connect();
        $builder = $db->table('offices');


        // $query = $builder->get(); 
        // SELECT * FROM offices;
 
        // $query = $builder->getWhere(['id' => 2]);
        // SELECT * FROM offices WHERE id = 1;
 
        // $query = $builder->select('id, code, name')->get();
 
        // $query = $builder->select('CONCAT(id, " - ", code) as officecode')->get();
 
        // $sql = "CONCAT(id, ' - ', code) as officecode";
        // $builder->select(new RawSql($sql));
        // $query = $builder->get();
 
        // $builder->selectMax('id');
        // $builder->selectMin('id');
        // $builder->selectAvg('id');
        // $builder->selectSum('id');
        // $builder->selectCount('id');
        // $query = $builder->get();
 
        // $builder->select("tickets.*, offices.name as OfficeName");
        // $builder->join("tickets", "tickets.office_id = offices.id");
        // $builder->where ("tickets.id", 1);
        // $query = $builder->get();
 
        // $builder->select('*');
        // $builder->where('name', 'HOWELL-WEHNER');
        // $builder->where('id', 1);
        // $query = $builder->get();
 
        //WHERE name = HOWELL-WEHNER AND id = 1
 
 
        // $builder->select('*');
        // $builder->where('name', 'HOWELL-WEHNER');
        // $builder->orWhere('id', 2);
        // $query = $builder->get();
 
        // $builder->select('*');
        // // $builder->where('name', 'HOWELL-WEHNER');
        // $builder->where('id >', 2);
        // $query = $builder->get();
 
        // $builder->select('*');
        // // $builder->where('name', 'HOWELL-WEHNER');
        // $builder->where('id >=', 2);
        // $query = $builder->get();
 
        // $builder->select('*');
        // // $builder->where('name', 'HOWELL-WEHNER');
        // $builder->whereIN('id', [1,2,3]);
        // $query = $builder->get();
 
        // $builder->select('*');
        // $builder->like('name', 'W');
        // $builder->orLike('name', 'A');
        // $query = $builder->get();
 
 
        // $builder->select('*');
        // $builder->orderBy('id', 'DESC');
        // $query = $builder->get();
        // $builder = $db->table('tickets');
        // $builder->selectCount('id');
        // $builder->select('state');
        // $builder->groupBy('state');
        // $query = $builder->get();
 
 
        // $data = [
        //     'code' => 'PICTD',
        //     'name' => 'PROVINCIAL INFORMATION AND COMMUNICATION TECHNOLOGY DIVISION',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ];
 
        // $builder->insert($data);
 
        // $builder->select("*");
        // $builder->where("code","PICTD");
        // $query = $builder->get();
 
 
        // $data = [
        //     'name' => 'PROVINCIAL INFORMATION AND COMMUNICATIONS TECHNOLOGY DIVISION',
        // ];
 
        // $builder->where('code', 'PICTD');
        // $builder->update($data);
 
        // $builder->select("*");
        // $builder->where("code", "PICTD");
        // $query = $builder->get();
 
        // $builder->where('code', 'PICTD');
        // $builder->delete();
 
        // $builder->select("*");
        // $builder->where("code", "PICTD");
        // $query = $builder->get();
 
        // $result = $query->getResult();
        // return json_encode($result);
 
        return view('welcome_message');
    }
}
