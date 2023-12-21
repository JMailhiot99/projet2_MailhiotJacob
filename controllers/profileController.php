<?php
require_once '../util/CRUD.php';

class info extends Crud
{

    public function informationUser()
    {
        $information = new Crud();
        $inf = $this->getById('user', 1);

        return $inf;
    }

    public function supprimer()
    {
        $del = new Crud();

    }
}
?>