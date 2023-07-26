<?php

declare(strict_types=1);

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter
{
    public function __construct(protected ApiClient $client)
    {
        //
    }

    public function subscribe(string $email)
    {
        return $this->client->lists->addListMember(config('services.mailchimp.default_list_id'), [
            'email_address' => $email,
            'status' => config('services.mailchimp.initial_member_status'),
        ]);
    }
}
