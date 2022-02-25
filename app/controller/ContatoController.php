<?php

namespace App\controller;

use App\model\Contato;

class ContatoController
{
    private $model;

    public function __construct()
    {
        $contato = new Contato;
        $this->model = $contato;
    }

    public function insert($data)
    {
        return $this->model->insert($data);
    }

    public function delete($id)
    {
        return $this->model->delete($id);
    }


    public function update($id, $data)
    {
        return $this->model->update($id, $data);
    }


    public function fetchAll()
    {
        return $this->model->fetchAll();
    }

    public function ContactById($id)
    {
        return $this->model->ContactById($id);
    }
}
