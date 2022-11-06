<!DOCTYPE HTML>
<html lang="pl">

<head>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Aktualny budżet</title>
</head>

<body>
  
<div>
{include file='includes/komunikaty.html' info=$info error=$error}
</div>

  <div class="container" style="width: 30%; position: absolute; left: 0px;">
    {include file='includes/menuUzytkownik.html'}
    {include file='includes/uzytkownikWspolnoty.html'}
  </div>

  <div class="container" style="width: 70%; position: absolute; left: 300px;">

    <span class="d-block p-2 bg-primary text-white">Szczegóły usterki</span>


    <div class="container" style="padding-top: 30px;">
      <div class="row">

        <div class="col-3">
          <label class="form-label">Temat:</label>
          <input class="form-control" type="text" value="{$szczegolyUsterki[0]->getTemat()}" readonly>
        </div>

        <div class="col-3">
          <label class="form-label">Data:</label>
          <input class="form-control" type="date" value="{$szczegolyUsterki[0]->getDataZgloszenia()}" readonly>
        </div>


      </div>
    </div>

    <div style="padding-top: 20px;">

      <div style="padding-top: 50px;">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Dokładny adres</label>
          <div class="col-7">
            <textarea class="form-control" name="adres" rows="3" value="aaa" readonly>{$szczegolyUsterki[0]->getBudynek()->getAdres()->getMiejscowosc()} .&#13;&#10; {$szczegolyUsterki[0]->getBudynek()->getAdres()->getUlica()} {$szczegolyUsterki[0]->getBudynek()->getAdres()->getNumerMieszkania()} .&#13;&#10; {$szczegolyUsterki[0]->getBudynek()->getAdres()->getKodPocztowy()}</textarea>
          </div>
        </div>

      </div>

      <div style="padding-top: 50px;">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Opis usterki</label>
          <div class="col-7">
            <textarea class="form-control" name="opis" rows="6" readonly>{$szczegolyUsterki[0]->getOpis()}</textarea>
          </div>
        </div>

        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <div class="alert alert-warning" role="alert">
                Status: {$szczegolyUsterki[0]->getStanRealizacji()}
              </div>
            </div>
            <div class="col-sm">
              <button type="button" onclick="location.href = '?task=usterki&action=przegladajUsterki';" class="btn btn-secondary ">Powrót</button>
            </div>


          </div>

</body>

</html>