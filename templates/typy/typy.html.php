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


   <div class="container" style="width: 70%; position: absolute; left: 300px;">

     <div class="col">

       <div>
         <table class="table table-striped">
           <thead>
             <tr>
               <th scope="col">Numer</th>
               <th scope="col">Nazwa Typu</th>
               <th scope="col">Ikona</th>
               <th scope="col">Edytuj</th>
               <th scope="col">Usuń</th>
             </tr>
           </thead>
           <tbody>


           {foreach $typy as $typ name=foo}  
             <tr>        
               <th scope="row">{$smarty.foreach.foo.iteration}</th>
               <td><a href="?task=typy&action=szczegolyUsterki&idUsterki={$typ->getId()}">{$typ->getName()}</a></td>
               <td> <img src="js/timeglider/icons/{$typ->getIcon()}" width="30"> </img> </td>   
               <td><form action="?task=typy&action=edytujTyp&idTypu={$typ->getId()}" method="post"><input type="submit" class="btn btn-success" value="Edytuj" /></form></td>
               <td><form action="?task=typy&action=usunTypPerform&idTypu={$typ->getId()}" method="post"><input type="submit" class="btn btn-warning" value="Usuń" /></form></td>        
             </tr>

             {/foreach}

           </tbody>
         </table>

         <button type="button" onclick="location.href = '?task=aplikacja&action=dashboard';" class="btn btn-secondary ">Powrót</button>


       </div>
     </div>
   </div>









 </body>

 </html>