<!DOCTYPE HTML>
<html lang="pl">

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Sklep - reklamacja</title>
</head>

<body>


  <div>
  {include file='includes/komunikaty.html' info=$info error=$error}
  </div>

  <div class="container" style="width: 30%; position: absolute; left: 0px;">
    {include file='includes/menuUzytkownik.html'}
    {include file='includes/uzytkownikWspolnoty.html'}
  </div>

  <div class="container" style="width: 70%; position: absolute; left: 300px; padding-bottom: 50px;">

    <center>
      <h2> Dodawanie wydarzenia</h>
    </center>
    <p>Uwaga! Obrazek musi mieć 60px x 60px</p>

    <form action="?task=wydarzenia&action=dodajWydarzeniePerform" method="post" enctype="multipart/form-data">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nazwa</label>
        <div class="col-4">
          <input class="form-control" name="name" type="text" placeholder="Podaj nazwę wydarzenia">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Obraz</label>
        <div class="col-4">
          <input type="file" name="fileToUpload" id="fileToUpload" >
        </div>
      </div>

      <!-- <input type="file" name="fileToUpload" id="fileToUpload"> -->

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Typ</label>
        <div class="col-4">
          <div class="form-group">

            <select class="form-control" id="type" name="type">
            {foreach from=$typy item=typ}
              <option value= {$typ->getId()}> {$typ->getName()}</option>
              {/foreach}

            </select>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" placeholder="Podaj opis usterki">Opis krotki</label>
        <div class="col-7">
          <textarea class="form-control" name="shortDescription" rows="6"></textarea>
        </div>

      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" placeholder="Podaj opis usterki">Opis długi</label>
        <div class="col-7">
          <textarea class="form-control" name="longDescription" rows="6"></textarea>
        </div>

      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" placeholder="Podaj opis usterki">Data rozpoczęcia</label>
        <div class="col-7">
          <input name="startDate" type="date">
        </div>

      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label" placeholder="Podaj opis usterki">Data zakończenia</label>
        <div class="col-7">
          <input name="endDate" type="date" >
        </div>

      </div>

      <div class="container">
        <div class="row">
          <div class="col-sm">
            <input type="submit" class="btn btn-success" value="Dodaj wydarzenie" />
          </div>
          <div class="col-sm">
            <button type="button" onclick="location.href = '?task=aplikacja&action=dashboard';" class="btn btn-secondary ">Powrót</button>
          </div>

        </div>
      </div>
    </form>

  </div>



</body>

</html>