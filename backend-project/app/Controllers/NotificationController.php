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
        $data = $this->request->getPost();

        if ($this->notificationModel->existsForUserAndTitle($data['user_id'], $data['title'])) {
            return $this->fail('Já existe uma notificação para este usuário.');
        }

        if (!$this->notificationModel->save($data)) {
            return $this->failValidationErrors($this->notificationModel->errors());
        }

        return $this->respondCreated(['message' => 'Notificação enviada com sucesso.']);
        
    }

    public function show($id = null)
    {
        if (!is_numeric($id) || (int)$id <= 0) {
            return $this->failValidationErrors('O ID deve ser um número inteiro válido.');
        }

        $data = $this->notificationModel->find($id);

        if (!$data) {
            return $this->failNotFound('Notificação não encontrada.');
        }

        $timestamp = strtotime($data['created_at']);
        $data['date'] = date('d-m-Y', $timestamp);
        $data['time'] = date('H:i', $timestamp);
        unset($data['created_at']);

        return $this->respond($data);
    }



    public function all()
    {
        $data = $this->notificationModel->getAllNotifications();

        if (empty($data)) {
            return $this->failNotFound('Não há notificações cadastradas.');
        }

        $formatted = array_map(function ($item) {
            $timestamp = strtotime($item['created_at']);
            $item['date'] = date('d-m-Y', $timestamp);
            $item['time'] = date('H:i', $timestamp);
            unset($item['created_at']);
            return $item;
        }, $data);

        return $this->respond($formatted);
    }

}