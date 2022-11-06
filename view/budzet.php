<?php
/**
 * @author Łukasz Socha <kontakt@lukasz-socha.pl>
 * @version: 1.0
 * @license http://www.gnu.org/copyleft/lesser.html
 */

include 'view/view.php';

class BudzetView extends View{
    public function  przegladajBudzet() {
        $this->setNecessery();
        $budzetModel= $this->loadModel('budzet');

        //todo wywołaj niezbedne funkcje modelu oraz zsetuj dane. 
        $budzet=$budzetModel->pobierzBudzet('aktualny');
        $this->set('budzet',$budzet);

        $sumaActM = $budzetModel->pobierzAktualneDochodyRoczneZMieszkan();
        $sumaActL = $budzetModel->pobierzAktualneDochodyRoczneZLokali();
        $this->set('sumaActM',$sumaActM);
        $this->set('sumaActL',$sumaActL);

        $wszystkieCzynszeM = $budzetModel->pobierzWszystkieDochodyZMieszkan();
        $wszystkieCzynszeL = $budzetModel->pobierzWszystkieDochodyZLokali();
        $this->set('wszystkieCzynszeM',$wszystkieCzynszeM);
        $this->set('wszystkieCzynszeL',$wszystkieCzynszeL);

        $Lokale = $budzetModel->pobierzDaneOLokalachUzytkownika($_SESSION['idUzytkownika']);
        $Mieszkania = $budzetModel->pobierzDaneOMieszkaniachUzytkownika($_SESSION['idUzytkownika']);
        $this->set('Lokale',$Lokale);
        $this->set('Mieszkania',$Mieszkania);
        
        $actWplywy = $budzetModel->pobierzAktualneWyplywy();
        $this->set('actWplywy',$actWplywy);

        $this->render('budzet/przegladajBudzet');
    }

    public function elementBudzetu($id) {
        $this->setNecessery();
        $budzetModel=$this->loadModel('budzet');

        $elementBudzetu=$budzetModel->pobierzSzczegolyWydatkowBudzetu($id);
        $this->set('elementBudzetu',$elementBudzetu);
        $this->render('budzet/elementBudzetu');
    }
    public function  przegladajPlanBudzetowy() {
        $this->setNecessery();
        $budzetModel= $this->loadModel('budzet');

        //todo wywołaj niezbedne funkcje modelu oraz zsetuj dane. 
        $budzet=$budzetModel->pobierzBudzet('planowany');
        $suma_wydatkow = 0;
        foreach ($budzet->getPlanyWydatkow() as $planwydatku) {
            $suma_wydatkow = $suma_wydatkow + $planwydatku->getKwota() * $planwydatku->getCzestotliwoscRoczna();
        }
        $this->set('budzet',$budzet);
        $this->set('suma_wydatkow',$suma_wydatkow);

        $wszystkieCzynszeL = $budzetModel->pobierzWszystkieDochodyZLokali();
        $this->set('wszystkieCzynszeL',$wszystkieCzynszeL);

        $cena_rownomiernego = $budzetModel->pobierzPlanowanaCeneRownomiernego($wszystkieCzynszeL);
        $cena_za_metr = $budzetModel->pobierzPlanowanaCeneZaMetr();

        $this->set('cena_rownomiernego',$cena_rownomiernego);
        $this->set('cena_za_metr',$cena_za_metr);

        $Lokale = $budzetModel->pobierzDaneOLokalachUzytkownika($_SESSION['idUzytkownika']);
        $Mieszkania = $budzetModel->pobierzDaneOMieszkaniachUzytkownika($_SESSION['idUzytkownika']);
        $this->set('Lokale',$Lokale);
        $this->set('Mieszkania',$Mieszkania);


        
        
        $this->render('budzet/przegladajPlanBudzetowy');
    }

    public function elementPlanuBudzetowego($id) {
        $this->setNecessery();
        $budzetModel=$this->loadModel('budzet');
        
        $elementBudzetu=$budzetModel->pobierzSzczegolyWydatowPlanuBudzetowego($id);
        $this->set('elementBudzetu',$elementBudzetu);

        $this->render('budzet/elementPlanuBudzetowego');
    }
}
?>
