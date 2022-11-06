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
        <div class="row">
          <div class="col">

            <h2>Wpływy</h2>
            <div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Numer</th>
                        <th scope="col">Wpływ</th>
                        <th scope="col">Wartość</th>
                      </tr>
                    </thead>
                    <tbody>
            
                      <tr>
                        <th scope="row">1</th>
                        <td>Czynsze mieszkaniowe</td>
                        <td>{$suma_wydatkow - $wszystkieCzynszeL}</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Czynsze lokalowe</td>
                        <td>{$wszystkieCzynszeL}</td>
            
                    </tbody>
                  </table>
                  
                  <div class="form-group row" style ="float: right;">
                    <label class="col-sm-2 col-form-label">Razem</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value = "{$suma_wydatkow}" readonly>
                    </div>
                  </div>
            </div>
     

          </div>

          <div class="col">
<h2>Wypływy</h2>
            <div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Numer</th>
                        <th scope="col">Nazwa</th>
                        <th scope="col">Kategoria</th>
                        <th scope="col">Koszt</th>
                      </tr>
                    </thead>
                    <tbody>
                    {if isset($budzet)}

                        {foreach from=$budzet->getPlanyWydatkow() item=planwydatku}
                        <tr>
                          <th scope="row">1</th>
                          <td> <a href="?task=budzet&action=elementPlanuBudzetowego&idElementuPlanuBudzetowego={$planwydatku->getId()}">{$planwydatku->getNazwa()}</a> </td>
                          <td>{$planwydatku->getKategoria()->getNazwa()}</td>
                          <td>{$planwydatku->getKwota() * $planwydatku->getCzestotliwoscRoczna()}</td>
                        </tr>

                        {/foreach}
                    {/if}
            
                    </tbody>
                  </table>
            
                  <div class="form-group row" style ="float: right;">
                    <label class="col-sm-2 col-form-label">Razem</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value = "{$suma_wydatkow}" readonly>
                    </div>
                  </div>
                  
            </div>
            

          </div>
        </div>

        <div style=" position: absolute; right: 100px;">
      

        <div class="container" style="padding-top: 50px">
       <h2>Twoje Czynsze</h2>

       <div class="col">
         <div>
           <table class="table table-striped">
             <thead>
               <tr>
                 <th scope="col">Numer</th>
                 <th scope="col">Typ</th>
                 <th scope="col">Czynsz</th>
                 <th scope="col">Adres</th>
                 <th scope="col">Numer lokalu</th>
               </tr>
             </thead>
             <tbody>
             {foreach from=$Lokale item=foo name=petla}
 
               <tr>
                 <th scope="row">{$smarty.foreach.petla.iteration}</th>
                 <td>Lokal</td>
                 <td>{$foo->getCzynsz()}</td>
                 <td>{$foo->getAdres()->getMiejscowosc()}</td>
                 <td>{$foo->getNumer()}</td>
               </tr>
               {/foreach}
               


               {foreach from=$Mieszkania item=foo name=petla2}
               <tr>
                 <th scope="row">{$smarty.foreach.petla.iteration + $smarty.foreach.petla.iteration}</th>
                 <td>Mieszkanie</td>
                 <td>{$foo->getPowierzchnia() * $cena_za_metr + $cena_rownomiernego}</td>
                 <td>{$foo->getAdres()->getMiejscowosc()}</td>
                 <td>{$foo->getNumer()}</td>
               </tr>
               {/foreach}

             </tbody>
           </table>



         </div>
       </div>
     </div>
      
          <div style="padding-top: 30px;">
          <button type="button"  onclick="location.href = '?task=aplikacja&action=dashboard';" class="btn btn-secondary ">Powrót</button>
        </div>

        </div>
        

      

      </div>





</body>
</html>