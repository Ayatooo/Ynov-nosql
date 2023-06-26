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

        $redis->flushall();


        try {
            $redis->connect();
        } catch (\Exception $e) {
            dd($e);
        }

        $file = fopen($csvFile, 'r');
        $header = fgetcsv($file);


        while (($data = fgetcsv($file)) !== false) {
            $record = array_combine($header, $data);
            $uuid = uniqid();
            $redis->hmset($uuid, [
                    'title' => $record['title'],
                    'name' => $record['name'],
                    'adress' => $record['adress'],
                    'realAdress' => $record['realAdress'],
                    'departement' => $record['departement'],
                    'country' => $record['country'],
                    'tel' => $record['tel'],
                    'email' => $record['email'],
            ]);
        }
        return 'Importation des données CSV terminée !';
    }
}
