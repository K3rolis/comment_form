<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $this->model = new \App\Models\CommentModel;


        $builder = $this->model->select('*');
        $builder->orderBy('post_id', 'desc');
        $builder->orderBy('reply_of', 'asc');
        $data['comments'] = $builder->findAll();


        // return $this->response->setJSON($data);

        return view('index', $data);
    }
}
