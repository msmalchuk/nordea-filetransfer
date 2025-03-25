<?php

namespace Profit\Nordea\API;

use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

class SignedApplicationRequest
{
    /**
     * @var ApplicationRequest
     */
    private $request;
    /**
     * @var Config
     */
    private $options;


    /**
     * SignedApplicationRequest constructor.
     * @param ApplicationRequest $request
     * @param Config $options
     */
    public function __construct(ApplicationRequest $request, Config $options)
    {
        $this->request = $request;
        $this->options = $options;
    }

    function toDocument()
    {
        $doc = new \DOMDocument();
        $doc->loadXML($this->request->toXML());

        $signer = new XMLSecurityDSig();

        $signer->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $signer->addReference(
            $doc,
            XMLSecurityDSig::SHA256,
            array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'),
            ['force_uri' => true]
        );

        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array('type'=>'private'));

        $objKey->loadKey($this->options->private_key_file, true);

        $signer->sign($objKey, $doc->documentElement);

        $signer->add509Cert($this->options->cert_file, true, true, ['issuerSerial' => true]);

        $signer->appendSignature($doc->documentElement);

        return $doc;
    }

    public function __toString()
    {
        $result = $this->toDocument()
            ->getElementsByTagName('ApplicationRequest')
            ->item(0)
            ->C14N();

        file_put_contents(realpath(__DIR__ . '/../steps/application_request.signed.php.xml'), $result);

        return $result;
    }

}