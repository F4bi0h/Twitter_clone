<?php
namespace App\Models;

use MF\Model\Model;

class Tweet extends Model {
    private $id;
    private $id_usuario;
    private $tweet;
    private $data;

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function salvar() {
        $query = "
            insert into tweets
                (id_usuario, tweet)
            values
                (:id_usuario, :tweet)
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->execute();

        return $this;
        
    }

    public function getAll() {
        $query = "
            select
                id, id_usuario, tweet, data
            from
                tweets
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $this->fetchAll(\PDO::FETCH_ASSOC);
    }
}
