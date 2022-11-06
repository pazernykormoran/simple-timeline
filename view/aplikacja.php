<?php
include 'classes/budzet.php';
include 'classes/planWydatku.php';
include 'view/view.php';

class AplikacjaView extends View{


    public function  dashboard() {
        $this->setNecessery();
        //todo wyciagnij z sesji i zsetuj informacje o użytkowniku do wyświetlania w dashboardzie TODO
        //echo $_SESSION['uzytkownik'];
        // //for tests:
        // $budzetArray=[];
        // array_push($budzetArray,new Budzet('id',1234,'typ','wspolnota',array()));
        // $this->set('budzetArray',$budzetArray);
        // $planWydatkowArray=[];
        // array_push($planWydatkowArray,new PlanWydatku('id',2,342,'nazwa','kategoria',array() ));
        // //end for tests
        $model=$this->loadModel('wydarzenia');
        $wydarzenia=$model->pobierzWydarzenia();
        // echo $wydarzenia[0]->getStartDate();
        // $budzetArray[0]->setPlanyWydatkow($planWydatkowArray);
        $this->set('wydarzenia',$wydarzenia);
        $this->set('rolaUzytkownika',$_SESSION['rolaUzytkownika']);
        $this->render('aplikacja/dashboard');
    }
    public function  logowanie() {
        $this->setNecessery();
        $this->render('aplikacja/logowanie');
    }
    public function zapomnialemHasla() {
        $this->setNecessery();
        $this->render('aplikacja/zapomnialemHasla');
    }
    public function pytaniePomocnicze($pytaniePomocnicze) {
        $this->setNecessery();
        $this->set('pytaniePomocnicze',$pytaniePomocnicze);
        $this->render('aplikacja/pytaniePomocnicze');
    }
    public function zmienHaslo(){
        $this->setNecessery();
        $this->render('aplikacja/zmienHaslo');
    }
}
?>
