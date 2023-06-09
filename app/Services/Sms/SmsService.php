<?php


namespace App\Services\Sms;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class SmsService
{
    private const BASE_URL = 'https://smsc.kz/sys/send.php';
    private const USERNAME = 'Baimen';
    private const PASSWORD = 'Qwerty123';

    public static function send(string $phone, string $message): JsonResponse
    {
        try {
            $client = new Client();
            $response = $client->get(self::BASE_URL, [
                'query' => [
                    'login'  => self::USERNAME,
                    'psw'    => self::PASSWORD,
                    'phones' => '7' . $phone,
                    'sender' => 'SBI-SPORT',
                    'mes'    => $message
                ]
            ]);

            $body = $response->getBody()->getContents();
            $statuses = [
                'status=100',
                'status=101',
                'status=102',
            ];
            if (in_array($body, $statuses)) {
                return response()->json([
                    'status' => 'PENDING'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => $body
                ], 400);
            }
        } catch (GuzzleException $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ], 500);
        }
    }
}
