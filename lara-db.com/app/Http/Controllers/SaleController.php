<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
ini_set('max_execution_time', 150000);
class SaleController extends Controller
{
    public function set_data()
    {

        $arAllSales = [];
        $limit = 500;
        for($e = 1; $e < 500; $e++){

            $arSales = $this->request_rest('http://' . config('some_data.ip_rest_data') . ':' . config('some_data.port_rest_data') . 
                '/api/sales?dateFrom=1973-01-05&dateTo=2024-12-05&page=' .
                 $e . '&key=' . config('some_data.key_rest_data') . '&limit=' . $limit);
            
            sleep(1);
            
            $arSalesForAdd = [];
            foreach ($arSales['data'] as $oneItem) {
                $arSalesForAdd[] = [
                    'g_number' => $oneItem['g_number'],
                    'date' => $oneItem['date'],
                    'last_change_date' => $oneItem['last_change_date'],
                    'supplier_article' => $oneItem['supplier_article'],
                    'tech_size' => $oneItem['tech_size'],
                    'barcode' => $oneItem['barcode'],
                    'total_price' => round($oneItem['total_price'], 2),
                    'discount_percent' => $oneItem['discount_percent'],
                    'is_supply' => $oneItem['is_supply'],
                    'is_realization' => $oneItem['is_realization'],
                    'promo_code_discount' => $oneItem['promo_code_discount'],
                    'warehouse_name' => $oneItem['warehouse_name'],
                    'country_name' => $oneItem['country_name'],
                    'oblast_okrug_name' => $oneItem['oblast_okrug_name'],
                    'region_name' => $oneItem['region_name'],
                    'income_id' => $oneItem['income_id'],
                    'sale_id' => $oneItem['sale_id'],
                    'odid' => $oneItem['odid'],
                    'spp' => $oneItem['spp'],
                    'for_pay' => $oneItem['for_pay'],
                    'finished_price' => $oneItem['finished_price'],
                    'price_with_disc' => $oneItem['price_with_disc'],
                    'nm_id' => $oneItem['nm_id'],
                    'subject' => $oneItem['subject'],
                    'category' => $oneItem['category'],
                    'brand' => $oneItem['brand'],
                    'is_storno' => $oneItem['is_storno'],
                ];
                
            }
            $countItems = DB::table('sales')->insert($arSalesForAdd);
            if(count($arSales['data']) < $limit) break;
        }

        $response = [
            'status' => 'ok',
            'total_items' => DB::table('sales')->count()
        ];

        return $response;

    }

    public function delete_data(){

        DB::table('sales')->delete();

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
