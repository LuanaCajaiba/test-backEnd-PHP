<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConversionsController extends Controller
{
    // public function index($dataCotacao){
    //     //buscar lista de cursos
    //     $file = fopen('https://exports.allyhub.co/', 'r');

    //     //$arrayCotacoes = arrayCotacao($dataCotacao);
    //     //$lista = Array();

    //     //foreach ($arrayCotacoes as $arrayCotacao)
    //     //{
    //         //for($i=0;$i<$var.lenth;$i++){

    //            // if (moeda = 'BRL') {
    //                // BRL/
    //            // }
                
    //        // }

    //    // }
    //     fclose($file);
    
    // }


    public function index(){
        //Busca lista de cursos
       // $file = fopen('https: exports.allyhub.co', "r");
    $file = curl_init ("https: exports.allyhub.co");

    curl_exec($file);

    
                // $arrayCotacao = arrayCotacao($dataCotacao);
                // $lista = array();

                // foreach ($file as $course)
                // {
                //     for($i=0;$i<$var.lenth;$i++)
                //     {
                //         if ($lista = fgets($file, 200, ";")) !==FALSE) 
                //         {
                           
                //         }
                //     }
                // }


        //         while ( ($data = fgetcsv($file, 200, ";")) !==FALSE ){
        
        //             $codigoMoeda = $data[3];
        //             $valorReal = $data[4];
        //             $cotacao = $data[6];
        
        //             $array = ['codigoMoeda' => $codigoMoeda, 'valorReal' => $valorReal, 'cotacao' => $cotacao];
        
        //             array_push($all_data, $array);
        //         }
        //         fclose($file);
               return $file;
        }





    public function arrayCotacao($dataCotacao){
        $file = fopen('http://www4.bcb.gov.br/Download/fechamento/$dataCotacao.csv', "r");
                $all_data = array();
                while ( ($data = fgetcsv($file, 200, ";")) !==FALSE ){
        
                    $codigoMoeda = $data[3];
                    $valorReal = $data[4];
                    $cotacao = $data[6];
        
                    $array = ['codigoMoeda' => $codigoMoeda, 'valorReal' => $valorReal, 'cotacao' => $cotacao];
        
                    array_push($all_data, $array);
                }
                fclose($file);
                return $all_data[2];
        }
}
