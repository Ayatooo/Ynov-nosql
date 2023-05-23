<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Predis\Client;

class RedisImportController extends Controller
{
    public function importCSV(Request $request)
    {
        $csvFile = storage_path('app/contacts.csv');

        $redis = new Client([
            'scheme' => 'tcp',
            'host' => 'host.docker.internal',
            'port' => 6379,
        ]);

        try {
            $redis->connect();
        } catch (\Exception $e) {
            dd($e);
        }

        if (($handle = fopen($csvFile, 'r')) !== false) {
            while (($data = fgetcsv($handle)) !== false) {
                $key = $data[0];
                $value = [
                    'title' => $data[0],
                    'name' => $data[1],
                    'address' => $data[2],
                    'realAddress' => $data[3],
                    'departement' => $data[4],
                    'country' => $data[5],
                    'tel' => $data[6],
                    'email' => $data[7],
                ];
                $redis->hmset($key, $value);
            }
            fclose($handle);
        }

        return 'Importation des données CSV terminée ! 🚩';
    }
}
