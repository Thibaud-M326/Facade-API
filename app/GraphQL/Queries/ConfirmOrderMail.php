<?php

namespace App\GraphQL\Queries;

use App\Models\User;
use App\Models\Order;
use App\Mail\ConfirmOrder;
use Illuminate\Support\Facades\Mail;

final class ConfirmOrderMail
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $userId = $args["user_id"];

        $user = User::where('id', $userId)
        ->get();
        
        $order = Order::where('user_id', $userId)
        ->orderByDesc('created_at')
        ->first();

        // dump($order->attributesToArray());

        $mailData = [
            $user,
            $order,
        ];

        $mail = Mail::to($user)->send(new ConfirmOrder($mailData));

        dump($mail);

        return [
            'isMailSentText' => "emailSent"
        ];
    }
}
