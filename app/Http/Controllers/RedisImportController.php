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
            return response()->json(['message' => 'Importation successfull'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function clear(Request $request)
    {
        $redis = new Client([
            'scheme' => 'tcp',
            'host' => 'host.docker.internal',
            'port' => 6379,
        ]);

        try {
            $redis->connect();
            $redis->flushall();
            return response()->json(['message' => 'Cache cleared'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
