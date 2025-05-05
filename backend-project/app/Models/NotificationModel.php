<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table      = 'notifications';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id', 
        'title', 
        'message', 
    ];

    protected $validationRules = [
        'user_id' => 'required|integer',
        'title'   => 'required|string|max_length[255]',
        'message' => 'required|string',
    ];

    protected $createdField  = 'created_at';
    protected $updatedField  = '';  
    protected $useTimestamps = true;

    public function getNotificationsByUser($userId, $limit = 50)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    public function existsForUserAndTitle(int $userId, string $title): bool
    {
        return $this->where('user_id', $userId)
                    ->where('title', $title)
                    ->countAllResults() > 0;
    }

    public function getAllNotifications($limit = 100)
    {
        return $this->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

}