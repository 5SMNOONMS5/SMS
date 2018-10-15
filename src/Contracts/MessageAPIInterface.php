<?php 

namespace Tasb00429\Sms\Contracts;

use Tasb00429\Sms\Message;

interface MessageAPIInterface 
{
    /**
     * Map the raw response data to a Message instance.
     *
     * @param  object $message
     * @param  array  $rawData
     * @return \Tasb00429\Sms\Message 
     */
    public function mapToMessageObject(Message $message, $rawData);

    /**
     * Map response raw data into message's properties
     *
     * @return message object 
     */
    public function getMessageObject();
}