<?php
session_start();

function callAction($controller){
    if(isset($_GET['action'])){
        $controller->{$_GET['action']}();
    }else{
        $controller->call('index');
    }
}

if(isset($_GET['task'])){
    if($_GET['task']=='aplikacja') {
        include 'controller/aplikacja.php';
        $ob = new AplikacjaController();
        callAction($ob);
    }
    else if($_GET['task']=='usterki') {
        include 'controller/usterki.php';
        $ob = new UsterkiController();
        if(!$ob->sprawdzCzyZalogowany()){
            $ob->redirect('?task=aplikacja&action=logowanie&error=Użytkownik nie jest zalogowany');
        }
        callAction($ob);
    }else if($_GET['task']=='budzet') {
        include 'controller/budzet.php';
        $ob = new BudzetController();
        if(!$ob->sprawdzCzyZalogowany()){
            $ob->redirect('?task=aplikacja&action=logowanie&error=Użytkownik nie jest zalogowany');
        }
        callAction($ob);
    }else if($_GET['task']=='wydarzenia') {
        include 'controller/wydarzenia.php';
        $ob = new WydarzeniaController();
        if(!$ob->sprawdzCzyZalogowany()){
            $ob->redirect('?task=aplikacja&action=logowanie&error=Użytkownik nie jest zalogowany');
        }
        callAction($ob);
    }
    else if($_GET['task']=='typy') {
        include 'controller/typy.php';
        $ob = new TypyController();
        if(!$ob->sprawdzCzyZalogowany()){
            $ob->redirect('?task=aplikacja&action=logowanie&error=Użytkownik nie jest zalogowany');
        }
        callAction($ob);
    }
}
 else {
include 'controller/aplikacja.php';
    $ob = new AplikacjaController();
    $_GET['action']='logowanie';
    callAction($ob);
}
?>
