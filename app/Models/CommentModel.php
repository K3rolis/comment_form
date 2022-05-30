<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'comments';
    protected $allowedFields = ['comment', 'name', 'email', 'created_at', 'reply_of', 'post_id'];
    protected $validationRules = [
        'comment' => 'required',
        'email' => 'required|valid_email',
        'name' => 'required'
    ];
    protected $validationMessages = [
        'comment' => [
            'required' => 'Comment field can not be empty'
        ],
        'email' => [
            'required' => 'Email field can not be empty',
            'valid_email' => 'Email is not valid',
        ],
        'name' => [
            'required' => 'Name field can not be empty'
        ]
    ];
}
