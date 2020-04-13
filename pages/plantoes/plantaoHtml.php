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
                <td style="font-size: 14px;">31</td>
                <td style="font-size: 14px;">CH normal</td>
                <td style="font-size: 14px;">CH Eventual</td>
                <td style="font-size: 14px;">CH ad noturno</td>
                
            </tr>
        </thead>

        <tbody>
            <?php

           // for($i=0; $i<count($medicos); $i++)
            $sql = "SELECT dataInicio, medicos.nome, configuracaoplantoes.legendaPlantao FROM plantoes INNER join medicos on plantoes.idmedico = medicos.idmedico INNER JOIN configuracaoplantoes ON plantoes.idConfiguracaoPlantao = configuracaoplantoes.idConfiguracaoPlantao";
            $result = mysqli_query($mysql_conn, $sql);
            if(mysqli_num_rows($result) > 0){
                
           
            while($row = mysqli_fetch_assoc($result)){
            
            ?>
            <tr >
                <td style="font-size: 11px;">5669</td>
                <td style="font-size: 9px ;"><?php echo $row['nome'];  ?></td>
                <td style="font-size: 11px;">Anestesiologista</td>
                
                <td style="font-size: 11px;">
                
                    <?php 
                    
                        if(substr($row['dataInicio'], 8, -9) == 1){
                            echo $row['legendaPlantao']; 
                        }
                        
                    ?> 
               
                </td> <!--1-->

                <td style="font-size: 11px ;">
                    
                    <?php 
                    
                        if(substr($row['dataInicio'], 8, -9) == 2){
                            echo $row['legendaPlantao']; 
                        }
                        
                    ?> 

                </td> <!--2-->

                <td style="font-size: 11px;">
            
                    <?php 
                        
                        if(substr($row['dataInicio'], 8, -9) == 3){
                            echo $row['legendaPlantao']; 
                        }
                            
                    ?> 

                </td> <!--3-->

                <td style="font-size: 11px;">
            
                 <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 4){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--4-->

                <td style="font-size: 11px ;">
                    
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 5){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--5-->

                <td style="font-size: 11px;">
                    
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 6){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--6-->

                <td style="font-size: 11px;">
                    
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 7){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--7-->

                <td style="font-size: 11px ;">
                    
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 8){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--8-->

                <td style="font-size: 11px;">
                <?php 
                
                if(substr($row['dataInicio'], 8, -9) == 9){
                    echo $row['legendaPlantao']; 
                }
                    
                ?> 
                </td> <!--9-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 10){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--10-->

                <td style="font-size: 11px ;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 11){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--11-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 12){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--12-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 13){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--13-->

                <td style="font-size: 11px ;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 14){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--14-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 15){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--15-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 16){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--16 -->

                <td style="font-size: 11px ;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 17){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--17-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 18){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--18-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 19){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td>  <!--19-->

                <td style="font-size: 11px ;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 20){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--20-->

                <td style="font-size: 11px;">
                
                <?php 
                
                if(substr($row['dataInicio'], 8, -9) == 21){
                    echo $row['legendaPlantao']; 
                }
                    
                ?> 

                </td> <!--21-->

                

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 22){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--22-->

                <td style="font-size: 11px ;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 23){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--23-->

                <td style="font-size: 11px;">
                
                <?php 
                
                if(substr($row['dataInicio'], 8, -9) == 24){
                    echo $row['legendaPlantao']; 
                }
                ?> 
                </td> <!--24-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 25){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--25-->

                <td style="font-size: 11px ;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 26){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--26-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 27){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--27-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 28){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--28-->

                <td style="font-size: 11px ;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 29){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--29-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 30){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--30-->

                <td style="font-size: 11px;">
            
                <?php 
                    
                    if(substr($row['dataInicio'], 8, -9) == 31){
                        echo $row['legendaPlantao']; 
                    }
                        
                    ?> 

                </td> <!--31-->

                <td style="font-size: 11px ;">
            
                    

                </td> <!--CH Normal-->

                <td style="font-size: 11px ;">
            
                </td><!--CH Eventual-->

                <td style="font-size: 11px;">
            
                </td> <!--CH Noturno-->
                
            </tr>
            <?php
                 }}
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