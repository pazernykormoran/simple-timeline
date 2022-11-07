<?php

include 'view/view.php';

class TypyView extends View{

    public function wyswietlTypy(){
        $this->setNecessery();
        $typyModel= $this->loadModel('typy');
        $this->set('typy', $typyModel->pobierzTypy());
        $this->set('rolaUzytkownika',$_SESSION['rolaUzytkownika']);
        $this->render('typy/typy');
    }

    public function  dodajTyp() {
        $this->setNecessery();
        $typyModel= $this->loadModel('typy');
        $typy = $typyModel->pobierzTypy();
        $this->set('typy', $typy);
        $this->set('rolaUzytkownika',$_SESSION['rolaUzytkownika']);
        $this->render('typy/dodajTyp');
    }
    public function edytujTyp($id) {
        $this->setNecessery();
        $typyModel= $this->loadModel('typy');
        $typy = $typyModel->pobierzTypy();
        $this->set('typy', $typy);
        $this->set('idTypu', $_GET['idTypu']);
        $this->set('typ', $typyModel->pobierzTypId($id));
        $this->set('rolaUzytkownika',$_SESSION['rolaUzytkownika']);
        $this->render('typy/edytujTyp');
    }
}
?>
