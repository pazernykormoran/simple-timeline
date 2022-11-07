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
      <h2> Edytowanie typu</h>
    </center>
    <p>Uwaga! Ikona musi mieć 100px x 100px</p>

    <form action="?task=typy&action=edytujTypPerform&idTypu={$typ->getId()}" method="post" enctype="multipart/form-data">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nazwa Typu</label>
        <div class="col-4">
          <input class="form-control" name="name" type="text" value="{$typ->getName()}">
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Ikona</label>
        <div class="col-4">
          <input type="file" name="fileToUpload" id="fileToUpload" >
        </div>
      </div>


      <div class="container">
        <div class="row">
          <div class="col-sm">
            <input type="submit" class="btn btn-success" value="Edytuj typ" />
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