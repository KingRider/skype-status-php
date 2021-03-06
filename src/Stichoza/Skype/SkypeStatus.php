<?php
namespace Stichoza\Skype;

use SimpleXMLElement;

/**
 * Get user's Skype online status
 *
 * @author      Levan Velijanashvili <me@stichoza.com>
 * @link        http://stichoza.com/
 * @version     v2.1.0
 */
class SkypeStatus
{
    private $xmlObject;
    
    private $languageArray = [
        "Unknown",
        "Offline",
        "Online",
        "Away",
        "Unavailable",
        "Do Not Disturb",
        "Invisible",
        "SkypeME"
    ];

    public function __construct($username)
    {
        $xmlString = @file_get_contents("http://mystatus.skype.com/" . $username . ".xml");
        return ($xmlString) ? $this->xmlObject = new SimpleXMLElement($xmlString) : null;
    }

    private function checkObject()
    {
        return ($this->xmlObject !== null);
    }

    public function getStatusCode()
    {
        return ($this->checkObject()) ? $this->xmlObject->Status->statusCode : null;
    }

    public function getStatusString()
    {
        return ($this->checkObject()) ? $this->languageArray[(int) $this->getStatusCode()] : null;
    }
}
