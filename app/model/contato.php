<?php

namespace App\model;

use PDO;

class Contato extends Connect
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=127.0.0.1;port=3307;dbname=contato', 'root', '123456');
    }



    public function fetchContact()
    {
        $contact = array();
        $query = $this->pdo->prepare("SELECT * FROM contato");
        $query->execute();


        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            $contact[] = array(
                'id' => $res['id'],
                'nome' => $res['nome'],
                'sobreNome' => $res['sobrenome'],
                'telefone' => $res['telefone'],
                'celular' => $res['celular'],
                'email' => $res['email']
            );
        }
        return  json_encode($contact);
    }


    public function fetchAll()
    {
        $contact = array();
        $query = $this->pdo->prepare("SELECT c.id, c.nome , c.sobrenome, c.telefone,
                                             c.celular,
                                             c.email, e.nome as nomeEmpresa 
                                             FROM contato as c 
                                             LEFT JOIN empresa as e  
                                             ON (e.contato_id = c.id)
                                             ");
        $query->execute();


        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            $contact[] = array(
                'id' => $res['id'],
                'nome' => $res['nome'],
                'sobreNome' => $res['sobrenome'],
                'telefone' => $res['telefone'],
                'celular' => $res['celular'],
                'email' => $res['email'],
                'nome_empresa' => $res['nomeEmpresa']
            );
        }
        return  json_encode($contact);
    }


    public function ContactById($id)
    {
        $contact = array();
        $query = $this->pdo->prepare("SELECT c.id, c.nome , c.sobrenome, c.telefone,
                                             c.celular,
                                             c.email, e.nome as nomeEmpresa 
                                             FROM contato as c 
                                             LEFT JOIN empresa as e  
                                             ON (e.contato_id = c.id)
                                             WHERE c.id= :id ");

        $query->bindValue(':id', $id);
        $query->execute();


        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            $contact[] = array(
                'id' => $res['id'],
                'nome' => $res['nome'],
                'sobreNome' => $res['sobrenome'],
                'telefone' => $res['telefone'],
                'celular' => $res['celular'],
                'email' => $res['email'],
                'nome_empresa' => $res['nomeEmpresa']
            );
        }
        return  json_encode($contact);
    }

    public function insert($data)
    {
        $sql = "INSERT INTO `contato` (`nome`, `sobrenome`, `data_nascimento`, `email`, `celular`, `telefone`) 
                                VALUES (:nome, :sobrenome, :data_nascimento, :email, :celular, :telefone)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $data['nome']);
        $stmt->bindValue(':sobrenome', $data['sobrenome']);
        $stmt->bindValue(':data_nascimento', $data['data_nascimento']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':telefone', $data['telefone']);
        $stmt->bindValue(':celular', $data['celular']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return json_decode('cadastrado com suceosso');
        } else {
            throw new \Exception("Não foi cadastrado");
        }
    }

    public function delete($id)
    {
        $sql = "DELETE from contato WHERE id = :id";
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
            'nome' => $data['nome'],
            'sobrenome' => $data['sobrenome'],
            'celular' => $data['celular'],
            'telefone' => $data['telefone'],
        ];

        $sql = "UPDATE contato SET nome = :nome , sobrenome = :sobrenome, celular = :celular, telefone = :telefone WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($data);
        if ($result) {
            return "Atualizado com Successo";
        }
    }
}
