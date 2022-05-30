<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CommentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'comment_id' => [
                'type' => 'INT',
                'constraint' => '11',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'post_id' => [
                'type' => 'VARCHAR',
                'constraint' => '11'
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '128'
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '256'
            ],
            'comment' => [
                'type' => 'text'
            ],
            'created_at' => [
                'type' => 'DATE',
                'null' => true
            ],
            'reply_of' => [
                'type' => 'INT',
                'constraint' => '11',
                'default' => '0'
            ]
        ]);

        $this->forge->addPrimaryKey('comment_id');
        $this->forge->createTable('comments');
    }

    public function down()
    {
        $this->forge->dropTable('comments');
    }
}
