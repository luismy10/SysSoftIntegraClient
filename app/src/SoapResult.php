<?php

namespace SysSoftIntegra\Src;

use Exception;
use SoapFault;
use DOMDocument;
use SysSoftIntegra\Src\Sunat;
use SysSoftIntegra\Src\SoapBuilder;

class SoapResult
{
    private $wsdlURL;

    private $filename;

    private $success = false;

    private $accepted = false;

    private $hashCode = "";

    private $description = "";

    private $ticket = "";

    public function __construct($wsdlURL, $filename)
    {
        $this->wsdlURL = $wsdlURL;
        $this->filename = $filename;
    }

    public function sendBill($xmlSend)
    {
        try {
            $client = new SoapBuilder($this->wsdlURL, array('trace' => true));
            $client->SoapClientCall($xmlSend);
            $client->SoapCall("sendBill");
            $result = $client->__getLastResponse();

            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($result);

            $DocXML = $DOM->getElementsByTagName('applicationResponse');
            $response = "";
            foreach ($DocXML as $Nodo) {
                $response = $Nodo->nodeValue;
            }

            if ($response == "" || $response == null) {
                throw new Exception("No se pudo obtener el contenido del nodo applicationResponse.");
            }

            $cdr = base64_decode($response);
            $archivo = fopen('../files/R-' . $this->filename . '.zip', 'w+');
            fputs($archivo, $cdr);
            fclose($archivo);
            chmod('../files/R-' . $this->filename . '.zip', 0777);

            $isExtract = Sunat::extractZip('../files/R-' . $this->filename . '.zip', '../files/');
            if (!$isExtract) {
                throw new Exception("No se pudo extraer el contenido del archivo zip.");
            }

            $xml = file_get_contents('../files/R-' . $this->filename . '.xml');
            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($xml);

            $DocXML = $DOM->getElementsByTagName('ResponseCode');
            $code = "";
            foreach ($DocXML as $Nodo) {
                $code = $Nodo->nodeValue;
            }

            $DocXML = $DOM->getElementsByTagName('Description');
            $description = "";
            foreach ($DocXML as $Nodo) {
                $description = $Nodo->nodeValue;
            }

            $DocXML = $DOM->getElementsByTagName('DigestValue');
            $hashCode = "";
            foreach ($DocXML as $Nodo) {
                $hashCode = $Nodo->nodeValue;
            }

            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            if (file_exists('../files/R-' . $this->filename . '.zip')) {
                unlink('../files/R-' . $this->filename . '.zip');
            }

            if ($code == "0") {
                $this->setAccepted(true);
            } else {
                $this->setAccepted(false);
            }
            $this->setCode($code);
            $this->setDescription($description);
            $this->setHashCode($hashCode);
            $this->setSuccess(true);
        } catch (SoapFault $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            $code = preg_replace('/[^0-9]/', '', $ex->faultcode);
            $message = $ex->faultstring;
            $this->setSuccess(false);
            $this->setCode($code);
            $this->setDescription($message);
        } catch (Exception $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            if (file_exists('../files/R-' . $this->filename . '.zip')) {
                unlink('../files/R-' . $this->filename . '.zip');
            }
            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setDescription($ex->getMessage());
        }
    }

    public function sendSumary($xmlSend)
    {
        try {
            $client = new SoapBuilder($this->wsdlURL, array('trace' => true));
            $client->SoapClientCall($xmlSend);
            $client->SoapCall("sendSummary");
            $result = $client->__getLastResponse();

            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($result);

            $DocXML = $DOM->getElementsByTagName('ticket');
            $ticket = "";
            foreach ($DocXML as $Nodo) {
                $ticket = $Nodo->nodeValue;
            }

            $this->setTicket($ticket);
            $this->setSuccess(true);
        } catch (Exception $ex) {
            $code = preg_replace('/[^0-9]/', '', $ex->faultcode);
            $message = $ex->faultstring;
            $this->setSuccess(false);
            $this->setCode($code);
            $this->setDescription($message);
        }
    }

    public function sendGetStatus($xmlSend)
    {
        try {
            $client = new SoapBuilder($this->wsdlURL, array('trace' => true));
            $client->SoapClientCall($xmlSend);
            $client->SoapCall("getStatus");
            $result = $client->__getLastResponse();

            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($result);

            $DocXML = $DOM->getElementsByTagName('status');
            $status = "";
            foreach ($DocXML as $Nodo) {
                $status = $Nodo->nodeValue;
            }
            if ($status == "") {
                throw new Exception("No se pudo obtener el contenido del nodo status.");
            }
            $cdr = base64_decode($status);
            $archivo = fopen('../files/R-' . $this->filename . '.zip', 'w+');
            fputs($archivo, $cdr);
            fclose($archivo);
            chmod('../files/R-' . $this->filename . '.zip', 0777);

            $isExtract = Sunat::extractZip('../files/R-' . $this->filename . '.zip', '../files/');
            if (!$isExtract) {
                throw new Exception("No se pudo extraer el contenido del archivo zip.");
            }

            $xml = file_get_contents('../files/R-' . $this->filename . '.xml');
            $DOM = new DOMDocument('1.0', 'utf-8');
            $DOM->preserveWhiteSpace = FALSE;
            $DOM->loadXML($xml);

            $DocXML = $DOM->getElementsByTagName('ResponseCode');
            $code = "";
            foreach ($DocXML as $Nodo) {
                $code = $Nodo->nodeValue;
            }

            $DocXML = $DOM->getElementsByTagName('Description');
            $description = "";
            foreach ($DocXML as $Nodo) {
                $description = $Nodo->nodeValue;
            }

            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            if (file_exists('../files/R-' . $this->filename . '.zip')) {
                unlink('../files/R-' . $this->filename . '.zip');
            }

            if ($code == "0") {
                $this->setAccepted(true);
            } else {
                $this->setAccepted(false);
            }

            $this->setCode($code);
            $this->setDescription($description);
            $this->setSuccess(true);
        } catch (SoapFault $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            $code = preg_replace('/[^0-9]/', '', $ex->faultcode);
            $message = $ex->faultstring;
            $this->setSuccess(false);
            $this->setCode($code);
            $this->setDescription($message);
        } catch (Exception $ex) {
            if (file_exists('../files/' . $this->filename . '.xml')) {
                unlink('../files/' . $this->filename . '.xml');
            }
            if (file_exists('../files/' . $this->filename . '.zip')) {
                unlink('../files/' . $this->filename . '.zip');
            }
            if (file_exists('../files/R-' . $this->filename . '.zip')) {
                unlink('../files/R-' . $this->filename . '.zip');
            }
            $this->setSuccess(false);
            $this->setCode("-1");
            $this->setDescription($ex->getMessage());
        }
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function isAccepted()
    {
        return $this->accepted;
    }

    public function setAccepted($accepted)
    {
        $this->accepted = $accepted;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getHashCode()
    {
        return $this->hashCode;
    }

    public function setHashCode($hashCode)
    {
        $this->hashCode = $hashCode;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    public function setTicket($ticket)
    {
        $this->ticket = $ticket;
    }
}