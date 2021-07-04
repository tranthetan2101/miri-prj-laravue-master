<?php

namespace App\Services;

use App\Domains\Auth\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CrmService
{
    protected $endpoint;

    public $errorCodes = [
        '203',
        '204',
        '400',
        '401',
        '403',
        '404',
        '405',
        '500',
        '504',
    ];

    public function __construct()
    {
        $this->endpoint = config('app.api_endpoint.crm');
    }

    public function saveCustomer(User $user)
    {
        $response = Http::post($this->endpoint.'/APICustomer/createCustomer', [
            'name' => $user->name,
            'email' => $user->email,
            'phoneNumber' => '09'.rand(11111111,99999999),
            'fullAddress' => 'Unknown',
            'sex' => true,
            'note' => 'From '.config('app.name'),
        ]);
        $result = json_decode($response->body(), true);
        if ($result['error'])
        {
            Log::error(__METHOD__.' - Response: '.json_encode($result));
        }
        return !$result['error'];
    }

    public function saveCustomerFromOrder(Order $order)
    {
        $response = Http::post($this->endpoint.'/APICustomer/createCustomer', [
            'name' => $order->name,
            'email' => $order->email,
            'phoneNumber' => $order->phone_number,
            'fullAddress' => $order->addr_number.' '.$order->addr_street.' '.($order->ward ? $order->ward->type.' '.$order->ward->name : '').' '.($order->district ? $order->district->type.' '.$order->district->name : '').' '.($order->city ? $order->city->type.' '.$order->city->name : ''),
            'sex' => true,
            'note' => 'From '.config('app.name').' Order'
        ]);
        $result = json_decode($response->body(), true);
        if ($result['error'])
        {
            Log::error(__METHOD__.' - Response: '.json_encode($result));
        }
        return !$result['error'];
    }

}
