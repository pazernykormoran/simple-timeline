<?php


include 'model/model.php';
include 'classes/budzet.php';
include 'classes/planWydatku.php';
include 'classes/wydatek.php';
include 'classes/Kategoria.php';
include 'classes/Lokal.php';
include 'classes/Mieszkanie.php';
include 'classes/Adres.php';


class BudzetModel extends Model{

    public function pobierzAktualneDochodyRoczneZMieszkan() {
        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT DISTINCT id, typ
        From budzety
        Where typ = 'aktualny' AND idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        foreach ($select as $row) {
            $idBudzetu = $row["id"];
        }

        $query="SELECT cz_m.kwota, cz_m.idBudzetu
        From czynsze_mieszkaniowe AS cz_m
        Where cz_m.idBudzetu = '".$idBudzetu."'";
        $select=$this->pdo->query($query);

        $suma = 0;
        foreach ($select as $row) {
            $suma = $suma + $row["kwota"];
        }
        return $suma;
    }
    public function pobierzAktualneDochodyRoczneZLokali() {
        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT DISTINCT id, typ
        From budzety
        Where typ = 'aktualny' AND idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        foreach ($select as $row) {
            $idBudzetu = $row["id"];
        }

        $query="SELECT cz_m.kwota, cz_m.idBudzetu
        From czynsze_lokalowe AS cz_m
        Where cz_m.idBudzetu = '".$idBudzetu."'";
        $select=$this->pdo->query($query);

        $suma = 0;
        foreach ($select as $row) {
            $suma = $suma + $row["kwota"];
        }
        return $suma;
    }

    public function pobierzWszystkieDochodyZMieszkan() {
        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT m.czynsz AS czynsz_mieszkaniowy, m.idBudynku, b.id, b.idWspolnoty , wm.id
        From mieszkania AS m
        LEFT JOIN `budynki` as b
        ON m.idBudynku = b.id
        LEFT JOIN `wspolnoty_mieszkaniowe` as wm
        ON b.idWspolnoty = wm.id
        WHERE idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        $suma = 0;
        foreach ($select as $row) {
            $suma = $suma + 12 * $row["czynsz_mieszkaniowy"];
        }
        return $suma;
    }

    public function pobierzWszystkieDochodyZLokali() {
        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT l.czynsz AS czynsz_lokalowy, l.idBudynku, b.id, b.idWspolnoty , wm.id
        From lokale AS l
        LEFT JOIN `budynki` as b
        ON l.idBudynku = b.id
        LEFT JOIN `wspolnoty_mieszkaniowe` as wm
        ON b.idWspolnoty = wm.id
        WHERE idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        $suma = 0;
        foreach ($select as $row) {
            $suma = $suma + 12 * $row["czynsz_lokalowy"];
        }
        return $suma;
    }

    public function pobierzAktualneWyplywy() {
        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT DISTINCT id, typ
        From budzety
        Where typ = 'aktualny' AND idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        foreach ($select as $row) {
            $idBudzetu = $row["id"];
        }

        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT w.kwota AS kwota_w, w.idPlanuWydatkow, pw.id, pw.idBudzetu
        From wydatki AS w
        LEFT JOIN `plan_wydatku` as pw
        ON w.idPlanuWydatkow = pw.id
        WHERE pw.idBudzetu='".$idBudzetu."'";
        $select=$this->pdo->query($query);
        $suma = 0;
        foreach ($select as $row) {
            $suma = $suma + $row["kwota_w"];
        }
        return $suma;
    }

    public function pobierzBudzet($typ) {
        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT DISTINCT id,idWspolnoty,rokRozliczeniowy, typ
        From budzety
        Where typ = '".$typ."' AND idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        $budzet;
        foreach ($select as $row) {
            $budzet=new Budzet($row["id"],$row["idWspolnoty"],$row["rokRozliczeniowy"],$row["typ"],array());
        }
        //echo $budzet->getId();
        $query="SELECT a.id AS idPlanuWydatku ,a.idBudzetu,a.idKategorii, a.nazwa AS nazwaPlanuWydatku, a.czestotliwoscRoczna, a.kwota, k.id AS idKategorii, k.nazwa AS nazwaKategorii, k.podzialkosztow
        From plan_wydatku AS a
        JOIN kategorie AS k ON a.idKategorii=k.id
        Where idBudzetu = '".$budzet->getId()."'";
        $select=$this->pdo->query($query);
        $plany_wydatkow=[];
        foreach ($select as $row) {
            $plany_wydatkow[]=new planWydatku($row["idPlanuWydatku"],$row["czestotliwoscRoczna"],$row["kwota"],$row["nazwaPlanuWydatku"],
            new Kategoria($row["idKategorii"],$row["podzialkosztow"],$row["nazwaKategorii"]),array());
            //echo $row["nazwaKategorii"]; echo "<br>";
        }     
        $budzet->setPlanyWydatkow($plany_wydatkow);
        
        return $budzet;
        //return $data;
        //zwraca obiekt Budzet;
    }
    public function pobierzSzczegolyWydatkowBudzetu($idPlanuWydatku) {
        $query="SELECT a.id AS idPlanuWydatku ,a.idBudzetu,a.idKategorii, a.nazwa AS nazwaPlanuWydatku, a.czestotliwoscRoczna, a.kwota, k.id AS idKategorii, k.nazwa AS nazwaKategorii, k.podzialkosztow
        From plan_wydatku AS a
        JOIN kategorie AS k ON a.idKategorii=k.id
        Where a.id = '".$idPlanuWydatku."'";
        $select=$this->pdo->query($query);
        $planWydatku;
        foreach ($select as $row) {
            $planWydatku=new planWydatku($row["idPlanuWydatku"],$row["czestotliwoscRoczna"],$row["kwota"],$row["nazwaPlanuWydatku"],
            new Kategoria($row["idKategorii"],$row["podzialkosztow"],$row["nazwaKategorii"]),$this->pobierzWydatki($idPlanuWydatku));
            //echo $row["nazwaKategorii"]; echo "<br>";
        }   
        return $planWydatku;

    }
    public function pobierzSzczegolyWydatowPlanuBudzetowego($idPlanuWydatku) {
        $query="SELECT a.id AS idPlanuWydatku ,a.idBudzetu,a.idKategorii, a.nazwa AS nazwaPlanuWydatku, a.czestotliwoscRoczna, a.kwota, k.id AS idKategorii, k.nazwa AS nazwaKategorii, k.podzialkosztow
        From plan_wydatku AS a
        JOIN kategorie AS k ON a.idKategorii=k.id
        Where a.id = '".$idPlanuWydatku."'";
        $select=$this->pdo->query($query);
        $planWydatku;
        foreach ($select as $row) {
            $planWydatku=new planWydatku($row["idPlanuWydatku"],$row["czestotliwoscRoczna"],$row["kwota"],$row["nazwaPlanuWydatku"],
            new Kategoria($row["idKategorii"],$row["podzialkosztow"],$row["nazwaKategorii"]),array());
        }   
        return $planWydatku;
    }
    private function pobierzWydatki($idPlanuWydatku) {
        
        $query="SELECT id ,idPlanuWydatkow , idUsterki, dataRealizacji, kwota, opis
        From wydatki
        Where idPlanuWydatkow = '".$idPlanuWydatku."'";
        $select=$this->pdo->query($query);
        $wydatki;
        foreach ($select as $row) {
            $wydatki[]=new Wydatek($row["id"],$row["idPlanuWydatkow"],$row["idUsterki"],$row["dataRealizacji"],$row["kwota"],$row["opis"]);
        }  
        //zwraca tabice oboektow PlanWydatku;
        if(isset($wydatki)){
            return $wydatki;
        }
        return null;
    }

    public function pobierzDaneOLokalachUzytkownika($idUzytkownika) {
        
        $query="SELECT l.id, l.czynsz, l.numer, a.ulica, a.nrMieszkania, A.kodPocztowy,a.miejscowosc
        FROM `uzytkownicy_lokale` as u
        Left Join lokale as l 
        on u.`idUzytkownika` = l.id
        LEFT JOIN adresy as a
        on a.idZewnetrzne = l.idBudynku
        WHERE `idUzytkownika` = ".$idUzytkownika;

        $select=$this->pdo->query($query);

        foreach ($select as $row) {
            $lokale[]= new Lokal($row["id"],$row["czynsz"],$row["numer"],null,null,null,null, new Adres(null,null,$row["miejscowosc"],$row["nrMieszkania"],$row["ulica"],null));
        }  
        //zwraca tabice oboektow PlanWydatku;
        if (isset($lokale))
        {
            return $lokale;
        }
        return null;
    }

    public function pobierzDaneOMieszkaniachUzytkownika($idUzytkownika) {
        
        $query="SELECT  m.czynsz, m.numer, a.ulica, a.miejscowosc, a.nrMieszkania, a.kodPocztowy
        FROM uzytkownicy_mieszkania as u
        Left Join mieszkania as m
        on u.`idMieszkania` = m.id
        LEFT JOIN adresy as a
        on a.idZewnetrzne = m.idBudynku
        WHERE `idUzytkownika` = ".$idUzytkownika;

        $select=$this->pdo->query($query);

        foreach ($select as $row) {
          
            $adres=new Adres(null,null,$row["miejscowosc"],$row["nrMieszkania"],$row["ulica"],null);
            $mieszkania[]= new Mieszkanie(null,$row["czynsz"],$row["numer"],null,null, $adres);
        }  

        if (isset($mieszkania))
        {
            return $mieszkania;
        }
        //return null;

        
    }

    


    private function pobierzKategorie($idPlanuWydatku) {
        
        //zwraca tablice obiektow Kategoria;
    }

    public function pobierzPlanowanaCeneRownomiernego($wszystkieCzynszeL) {
        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT DISTINCT id, typ
        From budzety
        Where typ = 'planowany' AND idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        foreach ($select as $row) {
            $idBudzetu = $row["id"];
        }

        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT COUNT(*) as liczba_m
        From mieszkania AS m
        LEFT JOIN `budynki` as b
        ON m.idBudynku = b.id
        LEFT JOIN `wspolnoty_mieszkaniowe` as wm
        ON b.idWspolnoty = wm.id
        WHERE idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        $liczba_mieszkan = 0;
        foreach ($select as $row) {
            $liczba_mieszkan = $row["liczba_m"];
        }

        $query="SELECT DISTINCT a.id, a.idKategorii, a.czestotliwoscRoczna as r_cz, a.kwota as r_kwota, k.podzialkosztow
        From plan_wydatku AS a, kategorie AS k
        Where a.idBudzetu = '".$idBudzetu."' AND k.podzialkosztow = 'rownomierny'";
        $select=$this->pdo->query($query);
        $suma_kosztow_rownomiernych = 0;
        foreach ($select as $row) {
            $suma_kosztow_rownomiernych = $suma_kosztow_rownomiernych + $row["r_kwota"] * $row["r_cz"];
        }
        $suma_kosztow_rownomiernych = $suma_kosztow_rownomiernych - $wszystkieCzynszeL;

        $planowana_cena_rownomiernego = $suma_kosztow_rownomiernych / $liczba_mieszkan / 12;

        return $planowana_cena_rownomiernego;
    }

    public function pobierzPlanowanaCeneZaMetr() {
        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT DISTINCT id, typ
        From budzety
        Where typ = 'planowany' AND idWspolnoty='".$idWspolnoty."'";
        $select=$this->pdo->query($query);
        foreach ($select as $row) {
            $idBudzetu = $row["id"];
        }

        $idWspolnoty=$_SESSION['idWspolnoty'];
        $query="SELECT SUM(m.powierzchnia) as suma_pow
        From mieszkania AS m
        LEFT JOIN `budynki` as b
        ON m.idBudynku = b.id
        LEFT JOIN `wspolnoty_mieszkaniowe` as wm
        ON b.idWspolnoty = wm.id
        WHERE idWspolnoty='".$idWspolnoty."'
        GROUP BY wm.id";
        $select=$this->pdo->query($query);
        $suma_pow = 0;
        foreach ($select as $row) {
            $suma_pow = $row["suma_pow"];
        }

        $query="SELECT DISTINCT a.id, a.idKategorii, a.czestotliwoscRoczna as r_cz, a.kwota as r_kwota, k.podzialkosztow
        From plan_wydatku AS a, kategorie AS k
        Where a.idBudzetu = '".$idBudzetu."' AND k.podzialkosztow = 'metrazowy'";
        $select=$this->pdo->query($query);
        $suma_kosztow_metrazowych = 0;
        foreach ($select as $row) {
            $suma_kosztow_metrazowych = $suma_kosztow_metrazowych + $row["r_kwota"] * $row["r_cz"];
        }
        $planowana_cena_za_metr = $suma_kosztow_metrazowych / $suma_pow / 12;

        return $planowana_cena_za_metr;
    }

}
?>
