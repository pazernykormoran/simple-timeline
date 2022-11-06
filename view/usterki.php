<?php

include 'view/view.php';

class UsterkiView extends View{
    public function  zglosUsterke() {
        $this->setNecessery();
        $usterkiModel= $this->loadModel('usterki');
        $budynkiDoWyswietlenia = $usterkiModel->pobierzAdresyBudynkowWspolnoty($_SESSION['idWspolnoty']);
        $this->set('adresy', $budynkiDoWyswietlenia);

        $this->render('usterki/zglosUsterke');
    }
    public function  przegladajUsterki() {
        $this->setNecessery();
        $usterkiModel= $this->loadModel('usterki');
        $this->set('usterki', $usterkiModel->pobierzUsterki($_SESSION['idWspolnoty']));
        $this->render('usterki/usterki');
    }
    public function szczegolyUsterki($idUsterki) {
        $this->setNecessery();
        $usterkiModel=$this->loadModel('usterki');
        $this->set('szczegolyUsterki', $usterkiModel->pobierzSzczegolyUsterki($idUsterki));
        $this->render('usterki/szczegolyUsterki');
    }
}
?>
