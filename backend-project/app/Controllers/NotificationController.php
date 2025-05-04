<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\NotificationModel;

class NotificationController extends ResourceController
{
    protected $format = 'json';
    protected $notificationModel;

    public function __construct() 
    {
        $this->notificationModel = new NotificationModel();
    }

   
    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->notificationModel->existsForUserAndTitle($data['user_id'], $data['title'])) {
            return $this->fail('Já existe uma notificação para este usuário.');
        }

        if (!$this->notificationModel->save($data)) {
            return $this->failValidationErrors($this->notificationModel->errors());
        }

        return $this->respondCreated(['message' => 'Notificação enviada com sucesso.']);
        
    }
    

    public function list($userId = null)
    {
        if (!is_numeric($userId) || (int)$userId <= 0) {
            return $this->failValidationErrors('O ID do usuário deve ser um número inteiro válido.');
        }
        
        $data = $this->notificationModel->getNotificationsByUser((int)$userId);

        if (empty($data)) {
            return $this->failNotFound('Não foram encontradas notificações para este usuário.');
        }

        $formated = array_map(function ($item) {
            $timestamp = strtotime($item['created_at']);
            $item['date'] = date('Y-m-d', $timestamp);
            $item['time'] = date('H:i:s', $timestamp);
            unset($item['created_at']);
            return $item;
        }, $data);
    
        return $this->respond($formated);
        
    }

    public function all()
    {
        $data = $this->notificationModel->getAllNotifications();

        if (empty($data)) {
            return $this->failNotFound('Não há notificações cadastradas.');
        }

        $formatted = array_map(function ($item) {
            $timestamp = strtotime($item['created_at']);
            $item['date'] = date('Y-m-d', $timestamp);
            $item['time'] = date('H:i:s', $timestamp);
            unset($item['created_at']);
            return $item;
        }, $data);

        return $this->respond($formatted);
    }

}