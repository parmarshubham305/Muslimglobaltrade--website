<?php

namespace App\Services\Mail;

use App\Models\Inquiry;
use App\Models\User;

class SendInquiryMailService extends TechVillageMail
{
    /**
     * Send mail to user
     *
     * @param  object  $request
     * @return array $response
     */
    public function send($request)
    {
        $emailTemplate = 'product-inquiry-admin';
        if ($request['type'] == 'user') {
            $emailTemplate = 'product-inquiry-user';
        }
        $email = $this->getTemplate(preference('dflt_lang'), $emailTemplate);

        $inquiryData = Inquiry::with(['user', 'product'])->where('id', $request['inquiry_id'])->first();
        if (! $email['status']) {
            return $email;
        }
        // // Replacing template variable
        $subject = str_replace('{product_name}', $inquiryData['product']['name'], $email->subject);

        $data = [
            '{logo}' => $this->logo,
            '{inquiry_title}' => $inquiryData['inquiry_title'],
            '{inquiry_desc}' => $inquiryData['inquiry_description'],
            '{customer_email}' => $inquiryData['user']['email'],
            '{customer_name}' => $inquiryData['user']['name'],
            '{product_name}' => $inquiryData['product']['name'],
            '{company_name}' => preference('company_name'),
        ];
        $message = str_replace(array_keys($data), $data, $email->body);

        return $this->email->sendEmail($request->email, $subject, $message, null, preference('company_name'));
    }
}
