<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function set_data()
    {

        $limit = config('some_data.limit_rest_data');
        for($e = 1; $e < 500; $e++){

            $arrStocks = $this->request_rest('http://' . config('some_data.ip_rest_data') . ':' . config('some_data.port_rest_data') . 
                '/api/stocks?dateFrom=2024-12-05&dateTo=' . date('Y-m-d', time()) . '&page=' .
                 $e . '&key=' . config('some_data.key_rest_data') . '&limit=' . $limit);
            
            sleep(1);
            
            $arrStocksForAdd = [];
            foreach ($arrStocks['data'] as $oneItem) {
                $arrStocksForAdd[] = [
                    'date' => $oneItem['date'],
                    'last_change_date' => $oneItem['last_change_date'],
                    'supplier_article' => $oneItem['supplier_article'],
                    'tech_size' => $oneItem['tech_size'],
                    'barcode' => $oneItem['barcode'],
                    'quantity' => $oneItem['quantity'],
                    'is_supply' => $oneItem['is_supply'],
                    'is_realization' => $oneItem['is_realization'],
                    'quantity_full' => $oneItem['quantity_full'],
                    'warehouse_name' => $oneItem['warehouse_name'],
                    'in_way_to_client' => $oneItem['in_way_to_client'],
                    'in_way_from_client' => $oneItem['in_way_from_client'],
                    'nm_id' => $oneItem['nm_id'],
                    'subject' => $oneItem['subject'],
                    'category' => $oneItem['category'],
                    'brand' => $oneItem['brand'],
                    'sc_code' => $oneItem['sc_code'],
                    'price' => $oneItem['price'],
                    'discount' => $oneItem['discount']
                ];
                
            }
            $countItems = DB::table('stocks')->insert($arrStocksForAdd);
            if(count($arrStocks['data']) < $limit) break;
        }

        $response = [
            'status' => 'ok',
            'total_items' => DB::table('stocks')->count()
        ];

        return $response;

    }

    private function delete_data(){

        DB::table('stocks')->delete();

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
