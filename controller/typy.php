<?php
include 'controller/controller.php';

class TypyController extends Controller{

    public function wyswietlTypy(){
        $view=$this->loadView('typy');
        $view->wyswietlTypy();
    }

    public function dodajTyp() {
        $view=$this->loadView('typy');
        $view->dodajTyp();
    }

    public function dodajTypPerform() {

        $modelTypu=$this->loadModel('typy');
        if($modelTypu->dodajTypPerform($_POST, $_FILES)){
            $this->redirect('?task=aplikacja&action=dashboard&info=Typ został pomyślnie dodany');
        }else{
            $this->redirect('?task=typy&action=dodajTyp&error=Błąd, podczas dodawania typu');
        }
    }

    public function edytujTyp() {
        if(isset($_GET['idTypu'])){
            $view=$this->loadView('typy');
            $view->edytujTyp($_GET['idTypu']);
        }else{
            $this->redirect('?task=aplikacja&action=dashboard&error=Nie ma takiego typu do edycji');
        }
    }

    public function edytujTypPerform() {
        $model=$this->loadModel('typy');
        $typ = $model->pobierzTypId($_GET['idTypu']);
        if($model->edytujTypPerform($_POST, $_FILES , $typ)){
            $this->redirect('?task=aplikacja&action=dashboard&info=Typ został pomyślnie edytowany');
        }else{
            $this->redirect('?task=aplikacja&action=dashboard&error=Błąd, podczas edytowania typu');
        }
    }

    public function usunTypPerform() {
        $model=$this->loadModel('typy');
        if($model->usunTypId($_GET['idTypu'])){
            $this->redirect('?task=aplikacja&action=dashboard&info=Typ został pomyślnie usunięty');
        }else{
            $this->redirect('?task=aplikacja&action=dashboard&error=Błąd, podczas usuwania typu');
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
