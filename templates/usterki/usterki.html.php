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
               <th scope="col">Temat</th>
               <th scope="col">Adres</th>
             </tr>
           </thead>
           <tbody>
          <script>
            var asd = []
            console.log(asd)
          </script>
           {foreach $usterki as $usterka name=foo}  
           <script>
            asd.push('123')
            console.log(asd)
            </script>
            {/foreach}


           {foreach $usterki as $usterka name=foo}  
             <tr>        
               <th scope="row">{$smarty.foreach.foo.iteration}</th>
               <td><a href="?task=usterki&action=szczegolyUsterki&idUsterki={$usterka->getId()}">{$usterka->getTemat()}</a></td>
               <td>{$usterka->getBudynek()->getAdres()->getMiejscowosc()} {$usterka->getBudynek()->getAdres()->getUlica()} {$usterka->getBudynek()->getAdres()->getUlica()} {$usterka->getBudynek()->getAdres()->getNumerMieszkania()} </td>                       
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