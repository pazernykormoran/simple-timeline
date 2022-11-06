 <!DOCTYPE HTML>
<html lang="pl">
<head>
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

    <div class="container"  style="width: 70%; position: absolute; left: 300px;">
  
    <span class="d-block p-2 bg-primary text-white">Szczegóły wydatku</span>


    <div class="container" style="padding-top: 30px;">
      <div class="row">
        
        <div class="col-3">
          <label class="form-label">Kategoria:</label>
          <input class="form-control" type="text" value = "{$elementBudzetu->getKategoria()->getNazwa()}" readonly>
        </div>

        <div class="col-3">
          <label class="form-label">Koszt:</label>
          <input class="form-control" type="number" value = "{$elementBudzetu->getKwota()}" readonly>
        </div>

        <div class="col-3">
          <label class="form-label">Częstotliwość (rocznie):</label>
          <input class="form-control" type="text" value = "{$elementBudzetu->getCzestotliwoscRoczna()}" readonly>
        </div>

      </div>
    </div>


    <div style="padding-top: 50px;">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Opis</label>
        <div class="col-7">
       <textarea class="form-control" name="opis" rows="6" readonly></textarea>
        </div>
    </div>


    <div style="padding-top: 50px;">
<h2>Stan realizacji</h2>

    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Numer</th>
          <th scope="col">Data</th>
          <th scope="col">Opis</th>
          <th scope="col">Kwota</th>
          {foreach from=$elementBudzetu->getWydatki() item=wydatek}
            {if $wydatek->getIdUsterki() != NULL}
              <th scope="col">Usterka</th>
            {/if}
          {/foreach}
        </tr>
      </thead>
      <tbody>
        {if isset($elementBudzetu->getWydatki())}
            {foreach from=$elementBudzetu->getWydatki() item=wydatek}
              <tr>
                <th scope="row">{$wydatek->getId()}</th>
                <td>{$wydatek->getDataRealizacji()}</td>
                <td>{$wydatek->getOpis()}</td>
                <td>{$wydatek->getKwota()}</td>
                {if $wydatek->getIdUsterki() != NULL}
                  <td><a href="?task=usterki&action=szczegolyUsterki&idUsterki={$wydatek->getIdUsterki()}">Usterka</a></td>
                {/if}
              </tr>
              {$wydatek->getId()}
              {$wydatek->getDataRealizacji()}
            {/foreach}
        {/if}


      </tbody>
    </table>

    </div>


      </div>

</body>
</html>