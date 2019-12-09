<?php

include '../opendb.php';
include_once('../func.php');


$medicos = getItensTable($mysql_conn,"medicos");

//header( "refresh:5;url=/cam-20191118/cam/pages/financeiro/teste2.php" );
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Plantão Médico</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="" >

        <div class="">
            <img src="../../pics/logo.png" alt="" style="width: 200px;">
        </div>

            <div class="" style="white-space: nowrap">
                    <p ><h5 >HOSPITAL RODOLFO FERNANDO MÊS/ANO JANEIRO/2019</h5> </p> 
                </div>
        <div class="">
            <h5>ESCALA DE SERVIÇO Setor/Categoria CAM Clinica de Anestesia de Mossoró</h5>
        </div>

       <div style=" width: 10px;" > 
        <table class="" border="2" style=" ">

            <thead>
            <tr>
                <td style="font-size: 14px;">CRM</td> 
                <td style="font-size: 14px;">NOME</td>
                <td style="font-size: 14px;">CARGO</td>
                <td style="font-size: 14px;">1</td>
                <td style="font-size: 14px;">2</td>
                <td style="font-size: 14px;">3</td>
                <td style="font-size: 14px;">4</td>
                <td style="font-size: 14px;">5</td>
                <td style="font-size: 14px;">6</td>
                <td style="font-size: 14px;">7</td>
                <td style="font-size: 14px;">8</td>
                <td style="font-size: 14px;">9</td>
                <td style="font-size: 14px;">10</td>
                <td style="font-size: 14px;">11</td>
                <td style="font-size: 14px;">12</td>
                <td style="font-size: 14px;">13</td>
                <td style="font-size: 14px;">14</td>
                <td style="font-size: 14px;">15</td>
                <td style="font-size: 14px;">16</td>
                <td style="font-size: 14px;">17</td>
                <td style="font-size: 14px;">18</td>
                <td style="font-size: 14px;">19</td>
                <td style="font-size: 14px;">20</td>
                <td style="font-size: 14px;">21</td>
                <td style="font-size: 14px;">22</td>
                <td style="font-size: 14px;">23</td>
                <td style="font-size: 14px;">24</td>
                <td style="font-size: 14px;">25</td>
                <td style="font-size: 14px;">26</td>
                <td style="font-size: 14px;">27</td>
                <td style="font-size: 14px;">28</td>
                <td style="font-size: 14px;">29</td>
                <td style="font-size: 14px;">30</td>
                <td style="font-size: 14px;">CH normal</td>
                <td style="font-size: 14px;">CH Eventual</td>
                <td style="font-size: 14px;">CH ad noturno</td>
                
            </tr>
        </thead>

        <tbody>
            <?php
            for($i=0; $i<count($medicos); $i++)
            {
            ?>
            <tr >
                <td style="font-size: 11px;">5669</td>
                <td style="font-size: 9px ;"><?= $medicos[$i] ['nome'] ?></td>
                <td style="font-size: 11px;">Anestesiologista</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px;">AA</td>
                <td style="font-size: 11px ;">AA</td>
                <td style="font-size: 11px;">AA</td>
                
            </tr>
            <?php
                }
            ?>
            
       </tbody>
                    
        </table>  
    </div>

        <table class="table" style="width: 97px; margin-top: 20px;">
           
        <thead>
            <tr>
                <td>
                    Legenda
                </td>

                <td>
                    Horário
                </td>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="font-size: 10px;">
                    D = Diurno
                </td>

                <td style="font-size: 10px;">
                        07:00 as 19:00 horas
                    </td>
                
            </tr>

            <tr>
                    <td style="font-size: 10px;">
                        N = Noturno
                    </td>
    
                    <td style="font-size: 10px;">
                            19:00 as 07:00 horas
                        </td>
                    
                </tr>
                <tr>
                        <td style="font-size: 10px;">
                            P = Plantao
                        </td>
        
                        <td style="font-size: 10px;">
                                24 horas
                            </td>
                        
                    </tr>
                    <tr>
                            <td style="font-size: 10px;">
                                M = Manha
                            </td>
            
                            <td style="font-size: 10px;">
                                    07:00 as 13:00 horas
                                </td>
                            
                        </tr>

                        <tr>
                                <td style="font-size: 10px;">
                                    T = Tarde
                                </td>
                
                                <td style="font-size: 10px;">
                                       13:00 as 19:00 horas
                                    </td>
                                
                            </tr>

                            <tr>
                                    <td style="font-size: 10px;">
                                        T/N = Tarde e Noite
                                    </td>
                    
                                    <td style="font-size: 10px;">
                                            13:00 as 07:00 horas
                                        </td>
                                    
                                </tr>

                                <tr>
                                        <td style="font-size: 10px;">
                                            M/N = Manha e Noite
                                        </td>
                        
                                        <td style="font-size: 10px;">
                                                07:00 as 13:00 horas 
                                            </td>
                                        
                                    </tr>

                               
        </tbody>
        </table>
       
    </div>
      
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>