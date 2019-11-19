<?php

namespace MahdiMajidzadeh\kavenegar;

use GuzzleHttp\Client;

class SMS
{
    private $base_url;
    private $prefix = 'sms';

    public $status = null;
    public $message = null;

    public function __construct()
    {
        $this->base_url = config('kavenegar.base_url').config('kavenegar.key').'/'.$this->prefix.'/';
    }

    public function send($receptor, $message, $sender = null, $date = null, $type = null, $localid = null)
    {
        if (is_array($receptor)) {
            $receptor = implode(',', $receptor);
        }
        if (is_array($localid)) {
            $localid = implode(',', $localid);
        }

        $params = [
            'receptor' => $receptor,
            'sender'   => $sender,
            'message'  => $message,
            'date'     => $date,
            'type'     => $type,
            'localid'  => $localid,
        ];

        return $this->execute('send.json', $params);
    }

    public function sendArray($receptor, $sender, $message, $date = null, $type = null, $localmessageid = null)
    {
        if (!is_array($receptor)) {
            $receptor = (array) $receptor;
        }
        if (!is_array($sender)) {
            $sender = (array) $sender;
        }
        if (!is_array($message)) {
            $message = (array) $message;
        }
        $repeat = count($receptor);
        if (!is_null($type) && !is_array($type)) {
            $type = array_fill(0, $repeat, $type);
        }
        if (!is_null($localmessageid) && !is_array($localmessageid)) {
            $localmessageid = array_fill(0, $repeat, $localmessageid);
        }

        $params = [
            'receptor'       => json_encode($receptor),
            'sender'         => json_encode($sender),
            'message'        => json_encode($message),
            'date'           => $date,
            'type'           => json_encode($type),
            'localmessageid' => json_encode($localmessageid),
        ];

        return $this->execute('sendarray.json', $params);
    }

    public function status($messageid)
    {
        $params = [
            'messageid' => is_array($messageid) ? implode(',', $messageid) : $messageid,
        ];

        return $this->execute('status.json', $params);
    }

    public function statusLocalMessageid($localid)
    {
        $params = [
            'localid' => is_array($localid) ? implode(',', $localid) : $localid,
        ];

        return $this->execute('statuslocalmessageid.json', $params);
    }

    public function select($messageid)
    {
        $params = [
            'messageid' => is_array($messageid) ? implode(',', $messageid) : $messageid,
        ];

        return $this->execute('select.json', $params);
    }

    public function selectOutbox($startdate, $enddate = null, $sender = null)
    {
        $params = [
            'startdate' => $startdate,
            'enddate'   => $enddate,
            'sender'    => $sender,
        ];

        return $this->execute('selectoutbox.json', $params);
    }

    public function latestOutbox($pagesize = null, $sender = null)
    {
        $params = [
            'pagesize' => $pagesize,
            'sender'   => $sender,
        ];

        return $this->execute('latestoutbox.json', $params);
    }

    public function countOutbox($statustext, $startdate = null, $status = 1)
    {
        $params = [
            'statustext' => $statustext,
            'startdate'  => $startdate,
            'status'     => $status,
        ];

        return $this->execute('countoutbox.json', $params);
    }

    public function cancel($messageid)
    {
        $params = [
            'messageid' => is_array($messageid) ? implode(',', $messageid) : $messageid,
        ];

        return $this->execute('cancel.json', $params);
    }

    public function receive($linenumber, $isread = 0)
    {
        $params = [
            'linenumber' => $linenumber,
            'isread'     => $isread,
        ];

        return $this->execute('receive.json', $params);
    }

    public function countInbox($startdate, $enddate, $linenumber, $isread = 0)
    {
        $params = [
            'startdate'  => $startdate,
            'enddate'    => $enddate,
            'linenumber' => $linenumber,
            'isread'     => $isread,
        ];

        return $this->execute('countinbox.json', $params);
    }

    public function countPostalcode($postalcode)
    {
        $params = [
            'postalcode' => $postalcode,
        ];

        return $this->execute('countpostalcode.json', $params);
    }

    public function sendByPostalcode($postalcode, $sender, $message, $mcistartindex, $mcicount, $mtnstartindex, $mtncount, $date = null)
    {
        $params = [
            'postalcode'    => $postalcode,
            'sender'        => $sender,
            'message'       => $message,
            'mcistartindex' => $mcistartindex,
            'mcicount'      => $mcicount,
            'mtnstartindex' => $mtnstartindex,
            'mtncount'      => $mtncount,
            'date'          => $date,
        ];

        return $this->execute('sendbypostalcode.json', $params);
    }

    private function execute($url, $params)
    {
        $client = new Client([
            'base_uri' => $this->base_url,
        ]);

        $response = $client->request('POST', $url, [
            'form_params' => $params,
        ]);

        $body = (string) $response->getBody();

        $result = json_decode($body);

        $this->status = $result->return->status;
        $this->message = $result->return->message;

        return $result->entries;
    }
}
