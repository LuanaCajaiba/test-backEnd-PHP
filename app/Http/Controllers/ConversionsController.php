<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConversionsController extends Controller
{

    public function index(Request $request)
    {

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://exports.allyhub.co');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $courses = json_decode(curl_exec($curl));
        curl_close($curl);

        $arrayCotacao = $this->arrayCotacao($request->get('dataCotacao'));

        $lista = array();

        foreach ($courses as $course) {
            $course_array = get_object_vars($course);

            $moeda = null;

            foreach ($course_array as $key => $value) {
                if ($key != "name" && $value > 0) {
                    $moeda = $key;
                }
            }

            if ($moeda != "BRL") {
                $cotacao = null;

                foreach ($arrayCotacao as $key => $value) {
                    if ($value['codigoMoeda'] == $moeda) {
                        $cotacao = $value;
                    }
                }

                $course_array['BRL'] = $course->$moeda * $cotacao['valorReal'];
            }

            if ($moeda = "BRL") {
                foreach ($course_array as $keyp => $valuep) {
                    $cotacao = null;

                    if ($keyp != "name" && $valuep == "") {
                        foreach ($arrayCotacao as $key => $value) {
                            if ($value['codigoMoeda'] == $keyp) {
                                $cotacao = $value;
                            }
                        }
                        $course_array[$keyp] = $course_array['BRL'] / $cotacao['cotacao'];
                    }
                }
            }

            array_push($lista, $course_array);
        }


        return response()->json($lista);
    }





    public function arrayCotacao($dataCotacao)
    {
        $url = "http://www4.bcb.gov.br/Download/fechamento/" . $dataCotacao . ".csv";
        $file = fopen($url, "r");
        $all_data = array();
        while (($data = fgetcsv($file, 200, ";")) !== FALSE) {

            $codigoMoeda = $data[3];
            $valorReal = $data[4];
            $cotacao = $data[6];

            $array = ['codigoMoeda' => $codigoMoeda, 'valorReal' => floatval(str_replace(',', '.', $valorReal)), 'cotacao' => floatval(str_replace(',', '.', $cotacao))];

            array_push($all_data, $array);
        }
        fclose($file);
        return $all_data;
    }
}
