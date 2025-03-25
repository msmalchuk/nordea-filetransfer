<?php

namespace Profit\Nordea\API\SoapTypes;


use Phpro\SoapClient\Type\RequestInterface;
use Profit\Nordea\API\ApplicationRequest;
use Profit\Nordea\API\Config;
use Profit\Nordea\API\Helper;
use Profit\Nordea\API\SignedApplicationRequest;

class DownloadFileListRequest implements RequestInterface
{

    /**
     * @var RequestHeader
     */
    private $RequestHeader = null;

    /**
     * @var base64Binary
     */
    private $ApplicationRequest = null;
    private $config;
    private $timestamp;

    /**
     * DownloadFileRequest constructor.
     * @param RequestHeader $RequestHeader
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->timestamp = new \DateTime();

        $this->setApplicationRequest(new ApplicationRequest());
        $this->setRequestHeader(new RequestHeader());
    }

    /**
     * @return RequestHeader
     */
    public function getRequestHeader()
    {
        return $this->RequestHeader;
    }

    /**
     * @param RequestHeader $RequestHeader
     */
    public function setRequestHeader(RequestHeader $rh)
    {
        $rh->setSenderId($this->config->sender_id);
        $rh->setLanguage($this->config->language);
        $rh->setUserAgent($this->config->user_agent);
        $rh->setReceiverId($this->config->receiver_id);

        $rh->setTimestamp($this->timestamp);
        $rh->setRequestId(Helper::hexRandom());

        $this->RequestHeader = $rh;
    }

    /**
     * @return base64Binary
     */
    public function getApplicationRequest()
    {
        return $this->ApplicationRequest;
    }

    /**
     * @param base64Binary $ApplicationRequest
     */
    public function setApplicationRequest(ApplicationRequest $ap)
    {
        $ap->command = 'DownloadFileList';
        $ap->file_type = 'VKEUR';
        $ap->status = 'ALL';
        $ap->timestamp = $this->timestamp;
        $ap->environment = $this->config->environment;
        $ap->software_id = $this->config->software_id;
        $ap->customer_id = $this->config->customer_id;
        $ap->target_id = '11111111A1';

        $this->ApplicationRequest=  new SignedApplicationRequest($ap, $this->config);
    }
}

