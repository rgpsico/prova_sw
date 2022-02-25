<?php

namespace App\model;

use PDO;

class empresa extends Connect
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=contato', 'root', '123456');
    }



    public function fetchAll()
    {
        $contact = array();
        $query = $this->pdo->prepare("SELECT * FROM empresa");
        $query->execute();


        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            $contact[] = array(
                'id' => $res['id'],
                'nome' => $res['nome']

            );
        }
        return  json_encode($contact);
    }

    public function EmpresaById($id)
    {
        $contact = array();
        $query = $this->pdo->prepare("SELECT * from empresa
                                             WHERE id= :id ");

        $query->bindValue(':id', $id);
        $query->execute();


        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            $contact[] = array(
                'id' => $res['id'],
                'nome' => $res['nome']
            );
        }
        return  json_encode($contact);
    }

    public function insert($data)
    {
        $sql = "INSERT INTO `empresa` (`nome`)VALUES (:nome)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return json_decode('cadastrado com sucesso');
        } else {
            throw new \Exception("Não foi cadastrado");
        }
    }

    public function delete($id)
    {
        $sql = "DELETE from empresa WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();

        if (!$result) {
            throw new \Exception("Nenhum usuário encontrado!");
        } else {
            return $stmt->rowCount() . "linha deletada";
        }
    }

    public function update($id, $data)
    {
        $data = [
            'id' => $id,
            'nome' => $data['nome']
        ];

        $sql = "UPDATE empresa SET nome = :nome WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($data);
        if ($result) {
            return "Atualizado com Successo";
        }
    }
}
