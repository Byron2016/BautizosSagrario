<?php
class postModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    
    public function getPostsPrueba()
    {
        $post = array(
            'id' => 1,
            'titulo' => 'Titulo Post',
            'cuerpo' => 'Cuerpo Post'
        );
        return $post;
    }
    public function getPosts()
    {
        $post = $this->_db->query("select * from posts");
        return $post->fetchall();
    }
    public function getPost($id)
    {
        $id = (int) $id;
        $post = $this->_db->query("select * from posts where id = $id");
        //$post = $this->_db->que
        return $post->fetch();
    }
    public function insertarPost($titulo, $cuerpo)
    {
        $this->_db->prepare("INSERT INTO posts VALUES (null, :titulo, :cuerpo)")
                ->execute(
                        array(
                           ':titulo' => $titulo,
                           ':cuerpo' => $cuerpo
                        ));
    }
    public function editarPost($id, $titulo, $cuerpo)
    {
        $id = (int) $id;
        
        $this->_db->prepare("UPDATE posts SET titulo = :titulo, cuerpo = :cuerpo WHERE id = :id")
                ->execute(
                        array(
                           ':id' => $id,
                           ':titulo' => $titulo,
                           ':cuerpo' => $cuerpo
                        ));
    }
    public function eliminarPost($id)
    {
        $id = (int) $id;
        $this->_db->query("DELETE FROM posts WHERE id = $id");
    }

    public function insertarPrueba($nombre)
    {
        $this->_db->prepare("INSERT INTO prueba VALUES (null, :nombre)")
                ->execute(
                        array(
                           ':nombre' => $nombre
                        ));
    }

    public function getPrueba()
    {
        $post = $this->_db->query("select * from prueba");
        return $post->fetchAll();
    }
    
}
?>