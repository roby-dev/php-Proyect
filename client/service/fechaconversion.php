<?php

    function convertir($hoy,$fechasql){        
        $dia=$hoy['mday'];
        $anio=$hoy['year'];
        $semana=$hoy['weekday'];
        $mes=$hoy['month'];

        switch($semana){
            case "Monday" :
                $semana="lunes";
            break; 
            case "Tuesday" :
                $semana="martes";
            break; 
            case "Wednesday" :
                $semana="miércoles";
            break; 
            case "Thursday" :
                $semana="jueves";
            break; 
            case "Friday" :
                $semana="viernes";
            break; 
            case "Saturday" :
                $semana="sábado";
            break; 
            case "Sunday" :
                $semana="domingo";
            break;            
        }

        switch($mes){
            case "January" :
                $mes="enero";
            break; 
            case "Tuesday" :
                $mes="febrero";
            break; 
            case "Wednesday" :
                $mes="marzo";
            break; 
            case "Thursday" :
                $mes="abril";
            break; 
            case "Friday" :
                $mes="mayo";
            break; 
            case "Saturday" :
                $mes="junio";
            break; 
            case "Sunday" :
                $mes="julio";
            break;      
            case "August" :
                $mes="agosto";
            break;
            case "Sunday" :
                $mes="septiembre";
            break;
            case "Sunday" :
                $mes="octubre";
            break;
            case "Sunday" :
                $mes="noviembre";
            break;
            case "Sunday" :
                $mes="diciembre";
            break;      
        }

        $fechahoy = explode(" - ",$fechasql);        

       

        if($fechahoy[0]=="$semana, $dia de $mes del $anio"){
            return "Creado hoy, $fechahoy[1]";
        }        
        
        return "Creado $fechasql";
    }   

    function convertirFechaHoy($hoy,$fechasql){
        $dia=$hoy['mday'];
        $anio=$hoy['year'];
        $semana=$hoy['weekday'];
        $mes=$hoy['month'];

        switch($semana){
            case "Monday" :
                $semana="lunes";
            break; 
            case "Tuesday" :
                $semana="martes";
            break; 
            case "Wednesday" :
                $semana="miércoles";
            break; 
            case "Thursday" :
                $semana="jueves";
            break; 
            case "Friday" :
                $semana="viernes";
            break; 
            case "Saturday" :
                $semana="sábado";
            break; 
            case "Sunday" :
                $semana="domingo";
            break;            
        }

        switch($mes){
            case "January" :
                $mes="enero";
            break; 
            case "Tuesday" :
                $mes="febrero";
            break; 
            case "Wednesday" :
                $mes="marzo";
            break; 
            case "Thursday" :
                $mes="abril";
            break; 
            case "Friday" :
                $mes="mayo";
            break; 
            case "Saturday" :
                $mes="junio";
            break; 
            case "Sunday" :
                $mes="julio";
            break;      
            case "August" :
                $mes="agosto";
            break;
            case "Sunday" :
                $mes="septiembre";
            break;
            case "Sunday" :
                $mes="octubre";
            break;
            case "Sunday" :
                $mes="noviembre";
            break;
            case "Sunday" :
                $mes="diciembre";
            break;      
        }

        $fechahoy = explode(" - ",$fechasql);   

        return "Creado hoy, $fechahoy[1]";
    }

?>