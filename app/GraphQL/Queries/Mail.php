<?php

namespace App\GraphQL\Queries;

final class Mail
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        

        return [
            'isMailSentText' => "world"
        ];
    }
}
