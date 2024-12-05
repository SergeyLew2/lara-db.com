<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    public function set_data()
    {

        $limit = config('some_data.limit_rest_data');
        for($e = 1; $e < 500; $e++){

            $arIncomes = $this->request_rest('http://' . config('some_data.ip_rest_data') . ':' . config('some_data.port_rest_data') . 
                '/api/incomes?dateFrom=1970-01-05&dateTo=' . date('Y-m-d', time()) . '&page=' .
                 $e . '&key=' . config('some_data.key_rest_data') . '&limit=' . $limit);
            
            sleep(1);
            
            $arrIncomesForAdd = [];
            foreach ($arIncomes['data'] as $oneItem) {
                $arrIncomesForAdd[] = [
                    'income_id' => $oneItem['income_id'],
                    'number' => $oneItem['number'],
                    'date' => $oneItem['date'],
                    'last_change_date' => $oneItem['last_change_date'],
                    'supplier_article' => $oneItem['supplier_article'],
                    'tech_size' => $oneItem['tech_size'],
                    'barcode' => $oneItem['barcode'],
                    'quantity' => $oneItem['quantity'],
                    'total_price' => round($oneItem['total_price'], 2),
                    'date_close' => $oneItem['date_close'],
                    'warehouse_name' => $oneItem['warehouse_name'],
                    'nm_id' => $oneItem['nm_id'],
                ];
                
            }
            $countItems = DB::table('incomes')->insert($arrIncomesForAdd);
            if(count($arIncomes['data']) < $limit) break;
        }

        $response = [
            'status' => 'ok',
            'total_items' => DB::table('incomes')->count()
        ];

        return $response;

    }

    private function delete_data(){

        DB::table('incomes')->delete();

    }

    protected function decode(string $json){

        return json_decode($json, true);

    }

    protected function request_rest(string $url){
        
        $ch=curl_init();
        $timeout=5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $result=curl_exec($ch);
        curl_close($ch);

        return $this->decode($result);
    }
}
