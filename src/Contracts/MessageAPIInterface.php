<?php 

namespace Maxin\Sms\Contracts;

use Maxin\Sms\Message;

interface MessageAPIInterface 
{
    /**
     * Map the raw response data to a Message instance.
     *
     * @param  object $message
     * @param  array  $rawData
     * @return \Maxin\Sms\Message 
     */
    public function mapToMessageObject(Message $message, $rawData);

    /**
     * Map response raw data into message's properties
     *
     * @return message object 
     */
    public function getMessageObject();
}