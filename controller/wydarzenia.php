<?php
include 'controller/controller.php';

class WydarzeniaController extends Controller{

    public function dodajWydarzenie() {
        $view=$this->loadView('wydarzenia');
        $view->dodajWydarzenie();
    }

    public function dodajWydarzeniePerform() {
        // $date = date("Y/m/d", strtotime($_POST['startDate']));
        // $this->redirect('?task=wydarzenia&action=dodajWydarzenie&info=Błąd, podczas dodawania wydarzenia' . $date . date("Y/m/d"));
        $modelWydarzenia=$this->loadModel('wydarzenia');
        if($modelWydarzenia->dodajWydarzeniePerform($_POST, $_FILES)){
            $this->redirect('?task=aplikacja&action=dashboard&info=Wydarzenie zostało pomyślnie dodane');
        }else{
            $this->redirect('?task=wydarzenia&action=dodajWydarzenie&error=Błąd, podczas dodawania wydarzenia');
        }
    }

    public function edytujWydarzenie() {
        if(isset($_GET['idWydarzenia'])){
            $view=$this->loadView('wydarzenia');
            $view->edytujWydarzenie($_GET['idWydarzenia']);
        }else{
            $this->redirect('?task=aplikacja&action=dashboard&error=Nie ma takiego wydarzenia do edycji');
        }
    }

    public function usunWydarzeniePerform() {
        $model=$this->loadModel('wydarzenia');
        if($model->usunWydarzenieId($_GET['idWydarzenia'])){
            $this->redirect('?task=aplikacja&action=dashboard&info=Wydarzenie zostało pomyślnie usunięte');
        }else{
            $this->redirect('?task=aplikacja&action=dashboard&error=Błąd, podczas usuwania wydarzenia');
        }
    }

    public function edytujWydarzeniePerform() {
        $model=$this->loadModel('wydarzenia');
        $wydarzenie = $model->pobierzWydarzenieId($_GET['idWydarzenia']);
        if($model->edytujWydarzeniePerform($_POST, $_FILES , $wydarzenie)){
            $this->redirect('?task=aplikacja&action=dashboard&info=Wydarzenie zostało pomyślnie dodane');
        }else{
            $this->redirect('?task=aplikacja&action=dashboard&error=Błąd, podczas edytowania wydarzenia');
        }
    }

    // public function przegladajUsterki() {
    //     $view=$this->loadView('usterki');

    //     $view->przegladajUsterki();
    // }

    // public function szczegolyUsterki() {
    //     if(isset($_GET['idUsterki'])){
    //         $view=$this->loadView('usterki');
    //         $view->szczegolyUsterki($_GET['idUsterki']);
    //     }else{
    //         $this->redirect('?task=usterki&action=przegladajUsterki&info=Błąd, nie ma takiej usterki');
    //     }
    // }
}
?>
