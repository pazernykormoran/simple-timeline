<?php

include 'view/view.php';

class WydarzeniaView extends View{
    public function  dodajWydarzenie() {
        $this->setNecessery();
        $typyModel= $this->loadModel('typy');
        $typy = $typyModel->pobierzTypy();
        $this->set('typy', $typy);
        $this->set('rolaUzytkownika',$_SESSION['rolaUzytkownika']);
        $this->render('wydarzenia/dodajWydarzenie');
    }
    public function edytujWydarzenie($id) {
        $this->setNecessery();
        $wydarzenieModel= $this->loadModel('wydarzenia');
        $typyModel= $this->loadModel('typy');
        $typy = $typyModel->pobierzTypy();
        $this->set('typy', $typy);
        $this->set('idWydarzenia', $_GET['idWydarzenia']);
        $this->set('wydarzenie', $wydarzenieModel->pobierzWydarzenieId($id));
        $this->set('rolaUzytkownika',$_SESSION['rolaUzytkownika']);
        $this->render('wydarzenia/edytujWydarzenie');
    }
}
?>
