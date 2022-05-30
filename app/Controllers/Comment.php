<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Comment extends BaseController
{
    private $timeNow;
    private $model;

    public function __construct()
    {
        $this->timeNow = Time::now('Europe/Vilnius');
        $this->model = new \App\Models\CommentModel;
    }
    public function create()
    {
        $email = $this->request->getPost('email');
        $name = $this->request->getPost('name');
        $comment = $this->request->getPost('comment');
        $postId = $this->getLastPostId();

        if($postId === null) {
            $postCheckId = 0;
        } else {
            $postCheckId = intval($postId->post_id);
        }

        $data = [
            'post_id' => ++$postCheckId,
            'email' => $email,
            'name' => $name,
            'comment' => $comment,
            'created_at' => $this->timeNow,
        ];

        if ($this->model->insert($data) === false) {
            $data['comments'] = $this->model->findAll();
            $data['errors'] = $this->model->errors();
            echo view('index', $data);
        } else {
            return redirect()->to('')->with('success', 'Commented successfully');
        }
    }
    public function reply()
    {        
        $replyOf = $this->request->getJsonVar('replyId');

        $postId = $this->getLastPostId();
        $postId = $this->getReplyPostId($replyOf);

        $data = [
            'post_id' => $postId->post_id,
            'email' => $this->request->getJsonVar('replyEmail'),
            'name' => $this->request->getJsonVar('replyName'),
            'comment' => $this->request->getJsonVar('replyComment'),
            'reply_of' => $this->request->getJsonVar('replyId'),
            'created_at' => $this->timeNow,
        ];

        if ($replyOf === null) {
            $data['reply_of'] = 0;
            return redirect()->back()->with('success', 'used comment/create ');
        }

        if ($this->model->insert($data) === false) {
            $data['comments'] = $this->model->findAll();
            echo view('index', $data);
        } else {
            return redirect()->back()->with('success', 'Commented successfully');
        }

        // dd($data);
        // dd($this->request->getPost('replyComment'));

    }

    public function getLastPostId()
    {
        // $builder = $this->model->select('*');
        // $builder->orderBy('post_id', 'DESC');
        // $builder->orderBy('comment_id', 'DESC');
        // $builder->limit(1);
        // $row = $builder->find();

        $query = $this->model->query("SELECT * FROM comments ORDER BY post_id DESC LIMIT 1");

        $row = $query->getRow();
        return $row;
    }
    public function getReplyPostId($id)
    {
        $query = $this->model->query("SELECT * FROM comments WHERE comment_id = $id");
        $row = $query->getRow();

        return $row;
    }
}
