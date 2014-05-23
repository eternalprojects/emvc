<?php
/**
 * Contains the mail handler class
 *
 * License:
 *
 * Copyright (c) 2010-2014, JPL Web Solutions,
 * Jesse P Lesperance <jesse@jplesperance.me>
 *
 * This file is part of EternalMVC.
 *
 * EternalMVC is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.  EternalMVC is distributed in the hope
 * that it will be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * See the GNU General Public License for more details. You should have
 * received a copy of the GNU General Public License along with EternalMVC.
 *
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2014 JPL Web Solutions
 * @license   http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU General Public License
 * @since     v1.2.1
 * @link      http://www.eternalmvc.info
 *            http://www.eternalprojects.com
 *            http://www.jplesperance.me
 * @package   Jpl\Core\Mail
 */
/**
 *
 * @package Jpl\Core\Mail
 */
namespace Jpl\Core;
use Jpl\Core\Exception;

/**
 * The Mail class specific to the EternalMVC framewprk
 *
 * This class is used for constructing and sending email.  It handles both
 * plain text and HTML formatted emails.  Allows email address verification,
 * read receipt and attachments.
 *
 * @author Jesse P Lesperance <jesse@jplesperance.me>
 * @copyright 2010-2014 JPL Web Solutions
 * @since v1.2.1
 * @todo: Create a unit test class - v1.3 - EMVC-9
 * @todo: Create an exception class for Mail - v1.3 - EMVC-8
 * @link http://jira.eternalprojects.com
 */
class Mail
{

    /**
     * The Name and version of the app
     *
     * @var string
     */
    protected $_mailvers = "EternalMVC PHP v1.2.1";
    /**
     * Email to use when validating mail server
     *
     * @var string
     *
     */
    protected $_knownMail = "local@localhost.com";
    /**
     * Whether to validate address or not
     *
     * @var bool
     *
     */
    protected $_checkAddr = false;
    /**
     * Whether to validate mail server or not
     *
     * @var bool
     *
     */
    protected $_checkServ = false;
    /**
     * The type of email to be created
     *
     * @var string
     *
     */
    protected $_type = "plain";
    /**
     * The character set to be used in the email
     *
     * @var string
     *
     */
    protected $_charset = "iso-8859-1";
    /**
     * The encoding to be used in the email
     *
     * @var string
     *
     */
    protected $_encoding = "quoted-printable";
    /**
     * A list of addresses to send email to
     *
     * @var array
     *
     */
    protected $_mailTo = array();
    /**
     * The email address of the sender
     *
     * @var string
     *
     */
    protected $_mailFrom;
    /**
     * The name of the person sending the mail
     *
     * @var string
     *
     */
    protected $_mailFromName;
    /**
     * The reply to address
     *
     * @var string
     *
     */
    protected $_mailReply;
    /**
     * A list of addresses to be copied on the mail
     *
     * @var array
     *
     */
    protected $_mailCc = array();
    /**
     * A list of addresses to be copied blindly
     *
     * @var array
     * @access protected
     */
    protected $_mailBcc = array();
    /**
     * Request a read receipt
     *
     * @var bool
     *
     */
    protected $_mailReceipt = false;
    /**
     * The priority of the email
     *
     * @var bool
     *
     */
    protected $_mailPriority = false;
    /**
     * The subject of the email
     *
     * @var string
     *
     */
    protected $_mailSubj = "";
    /**
     * The content of the message body
     *
     * @var string
     *
     */
    protected $_mailBody = "";
    /**
     * Additional mail headers
     *
     * @var bool
     *
     */
    protected $_mailHeaders = false;
    /**
     * Attached files
     *
     * @var mixed
     *
     */
    protected $_attFile = false;
    /**
     * Tracks which addresses successfully had the email sent to them
     *
     * @var array
     *
     */
    protected $_mailSent = array();

    /**
     * The default constructor
     *
     * The constructor method validates an accepted type is specified
     *
     * @param string $type The type of email to create
     * @throws \Jpl\Core\Exception
     * @return \Jpl\Core\Mail
     */
    public function __constructor($type = "plain")
    {
        $this->setType($type);
        return $this;
    }

    public function setType($type){
        if(($type != "plain" && $type != "html") || !is_string($type)){
            throw new Exception("Invalid mail type provided: '".$type."'.  Only 'plain' and 'html' are supported");
        }
        $this->_type = $type;

    }

    /**
     * A method to enable the validation of email addresses
     *
     * @return void
     */
    public function enableAddressValidation()
    {
        $this->_checkAddr = true;
    }

    /**
     * A method to enable validation of the mail server
     *
     * @return void
     */
    public function enableServerValidation()
    {
        $this->_checkserv = true;
    }

    /**
     * set the recipient(s) of the email
     *
     * @param mixed $to
     * @return void
     */
    public function setTo($to)
    {
        if (is_array($to)) {
            foreach ($to as $res) {
                if ($this->_validateAddress($res)){
                    $this->_mailTo[] = $res;
                }
            }
        }
        if (is_string($to)) {
            trim($to);
            if ($this->_validateAddress($to)){
                $this->_mailTo[] = $to;
            }
        }
    }

    /**
     * Set who should receive a copy of the email
     *
     * @param mixed $cc
     * @return void
     */
    public function setCc($cc)
    {
        if (is_array($cc)) {
            foreach ($cc as $res) {
                if ($this->_validateAddress($res)){
                    $this->_mailCc[] = $res;
                }
            }
        }
        if (is_string($cc)) {
            trim($cc);
            if ($this->_validateAddress($cc)){
                $this->_mailCc[] = $cc;
            }
        }
    }

    /**
     * Set who should receive a blind copy of the emil
     *
     * @param mixed $bcc
     * @return void
     */
    public function setBcc($bcc)
    {
        if (is_array($bcc)) {
            foreach ($bcc as $res) {
                if ($this->_validateAddress($res)){
                    $this->_mailBcc[] = $res;
                }
            }
        }
        if (is_string($bcc)) {
            trim($bcc);
            if ($this->_validateAddress($bcc)){
                $this->_mailBcc[] = $bcc;
            }
        }
    }

    /**
     * Validate that the email address provided is correctly formatted
     *
     * @param $var
     * @return bool
     *
     */
    protected function _validateAddress($email)
    {
        $temp = "^[_a-zA-Z0-9-](\.{0,1}[_a-zA-Z0-9-])*@([a-zA-Z0-9-]{2,}\.){0,}[a-zA-Z0-9-]{3,}(\.[a-zA-Z]{2,4}){1,2}$";
        if ($this->_checkAddr) {
            if (preg($temp, $email)){
                return true;
            }else {
                $this->_mailsent[$email] = false;
                return false;
            }
        } else{
            return true;
        }
    }

    /**
     * Set the name and the email of the sender.
     *
     * @param string $from Email address of sender
     * @param mixed $name Name of the sender
     * @throws \Jpl\Core\Exception
     * @return void
     */
    public function setFrom($from, $name = false)
    {
        if (is_string($from)) {
            trim($from);
            if ($this->_validateAddress($from)) {
                $this->_mailFrom = $from;
                $this->_mailReply = $from;
            }
        }else{
            throw new Exception("Invalid first parameter for ".__CLASS__."::".__METHOD__.": Only a string is allowed");
        }
        if ($name && is_string($name)) {
            trim($name);
            $this->_mailFromName = $name;
        }else{
            $this->_mailFromName = $this->_mailFrom;
        }
    }

    /**
     * Set the reply to email address
     *
     * @param string $to
     * @return void
     */
    public function setReply($to)
    {
        if (is_string($to)) {
            trim($to);
            if ($this->_validateAddress($to)){
                $this->_mailReply = $to;
            }
        }
    }

    /**
     * Set the subject line of the email
     *
     * @param string $var
     * @throws \Jpl\Core\Exception
     * @return void
     */
    public function setSubject($var)
    {
        if (is_string($var)){
            $this->_mailSubj = strtr($var, "\r\n", "  ");
        }else{
            throw new Exception("Invalid subject provided.  The subject must be a string.");
        }
    }
    /**
     * Set the message body of the email
     *
     * @param string $var
     * @param string $charset
     * @param string $encoding
     * @throws \Jpl\Core\Exception
     * @return void
     */
    public function setMessage($var = "", $charset = "iso-8859-1", $encoding = "quoted-printable")
    {
        if (is_string($var)){
            $this->_mailBody = $var;
        }else{
            throw new Exception("Invalid message body provided.  The message body must be a string");
        }
        $this->_charset = strtolower($charset);
        $this->_encoding = strtolower($encoding);
    }

    /**
     * Add an attachment to the email
     *
     * @param string $file
     * @param string $filename
     * @param int $maxsize
     * @param string $disp
     * @param string $type
     * @throws \Jpl\Core\Exception
     * @return void
     */
    public function addAttachment($file, $filename = false, $maxsize = false, $disp = "attachment", $type = false)
    {
        if (!$filename) $filename = $file;
        if (is_readable($file)) { // get a local file
            if ($maxsize && $maxsize < filesize($file)) {
                clearstatcache();
                throw new Exception("The file is too large to attach");
            } else {
                $this->_attFile['name'][] = $filename;
                $this->_attFile['type'][] =  ($type)?$type:"application/octet-stream";
                $this->_attFile['tmp_name'][] = $file;
                $this->_attFile['size'][] = filesize($file);
                $this->_attFile['disp'][] = ($disp != "inline")?"attachment":$disp;

            }
        } else { // get an URL (allow_url_fopen in php.ini must be true for that)
            $fp = @fopen($file, 'rb');
            if ($fp) {
                $this->_attFile['name'][] = $filename;
                $this->_attFile['type'][] =  ($type)?$type:"application/octet-stream";
                $this->_attFile['tmp_name'][] = $file;
                $this->_attFile['size'][] = 1024;
                $this->_attFile['disp'][] = ($disp != "inline")?"attachment":$disp;
                fclose($fp);
            } else{
                throw new Exception("The remote file could not be found or opened");
            }
        }
    }

    /**
     * Turn on read receipt on the message
     * @param string $to
     * @throws \Jpl\Core\Exception
     * @return void
     */
    public function setReceipt($to = false)
    {
        $this->_mailReceipt = $this->_mailFrom;
        if ($to && is_string($to)) {
            trim($to);
            if ($this->_validateAddress($to)) {
                $this->_mailReceipt = $to;
            }
        }else{
            throw new Exception("No valid address provided");
        }
    }

    /**
     * Set the priority of the message
     *
     * @param int $num
     * @throws Exception
     * @return void
     */
    public function setPriority($num)
    {
        if(!is_int($num)){
            throw new Exception("The Priority parameter must be an interger");
        }
        if ($num >= 1 && $num <= 5){
            $this->mailpriority = $num;
        }else{
            throw new Exception("Priority must be a number between one and five");
        }
    }

    /**
     * Send the email
     *
     * @return void
     */
    public function send()
    {
        $this->_createHeaders();
        if (count($this->_mailTo) > 0 && strlen($this->_mailFrom) > 3) {
            foreach ($this->_mailTo as $res) {
                $serv = $this->_validateServer($res);
                $this->_serv[$res] = $serv[1];
                if ($serv[0] == true){
                    $this->_mailSent[$res] = mail($res, $this->_mailSubj, $this->_mailBody, $this->_mailHeaders);
                }else{
                    $this->_mailsent[$res] = false;
                }
            }
        }
    }

    /**
     * Check to see if the email was successfully sent to a specified address
     *
     * @param string $addr
     * @return bool
     */
    public function isSent($addr)
    {
        return (@$this->_mailSent[$addr])?$this->_mailSent[$addr]:false;
    }

    /**
     * Is the specified email valid?
     *
     * @param string $addr
     * @return bool
     */
    public function checkAddress($addr)
    {
        $this->_checkAddr = true;
        $result = $this->_validateAddress($addr);
        $this->_checkAddr = false;
        return $result;
    }

    /**
     * is the email server valid?
     *
     * @param string $addr
     * @return bool
     */
    public function checkServer($addr)
    {
        $this->_checkServ = true;
        $result = $this->_validateServer($addr);
        $result = $result[0];
        $this->_checkServ = false;
        return $result;
    }

    /**
     * Validate that the server is valid
     *
     * @param string $email
     * @return array
     * @access protected
     */
    protected function _validateServer($email)
    {
        // no validation if OS is Windows, return true
        if (defined("PHP_OS") && !strcmp(substr(PHP_OS, 0, 3), "WIN")){
            return array(true, "This method is not supported on Windows systems");
        }
        list($user, $domain) = explode("@", $email, 2);
        $mxlist = false;
        if ($this->_checkServ) {
            @getmxrr($domain, $mxlist);
            $result = array(false, $domain . " Mailserver not found");
            if ($mxlist) {
                foreach ($mxlist as $mx) {
                    $fp = fsockopen($mx, 25, $errno, $errstr, 20);
                    if (!$fp){
                        continue;
                    }
                    socket_set_blocking($fp, false);
                    $s = 0;
                    $c = 0;
                    $out = "";
                    do {
                        $out = fgets($fp, 2500);
                        if (preg("^220", $out)) {
                            $s = 0;
                            $out = "";
                            $c++;
                        } else {
                            if (($c > 0 && $out == "")) break;
                            else $s++;
                            if ($s > 9999) break;
                        }
                    } while ($out == "");
                    socket_set_blocking($fp, true);
                    fputs($fp, "HELO EternalMail\n");
                    $out = fgets($fp, 3000);
                    fputs($fp, "MAIL FROM: $this->_knownMail\n");
                    $out = fgets($fp, 3000);
                    fputs($fp, "RCPT TO: $email\n");
                    $out = fgets($fp, 3000);
                    if (preg("^250", $out)){
                        $result = array(true, $out);
                    }else{
                        $result = array(false, $out);
                    }
                    fputs($fp, "quit\n");
                    fclose($fp);
                    if ($result[0]) break;
                }
            } else{
                $result = array(false, $email . " Function getmxrr() not supported or Mailserver not found");
            }
        } else{
            $result = array(true, $email . " Mailserver not checked");
        }

        return $result;
    }

    /**
     * get The raw email data
     *
     * @return string
     */
    public function getRawData()
    {
        $this->_createHeaders();
        $out = "";
        if (count($this->_mailTo) > 0) {
            foreach ($this->_mailTo as $res) $out .= "TO: " . $res . "<br /><br />\n";
        }
        $out .= "SUBJECT: " . $this->_mailSubj . "<br /><br />\n";
        $out .= "MESSAGE: " . $this->_mailBody . "<br /><br />\n";
        $out .= "HEADERS: " . htmlentities($this->_mailHeaders) . "<br /><br />\n";
        return $out;
    }

    /**
     * Create the general headers for the email message
     *
     * @return void
     */
    protected function _createHeaders()
    {
        $this->headers["Mime-Version"] = "1.0";
        $this->headers["Content-Type"] = "text/$this->_type; charset=\"$this->_charset\"";
        $this->headers["Content-Transfer-Encoding"] = "$this->_encoding";
        if ($this->_mailFrom) {
            if ($this->_mailFromName){
                $this->headers["From"] = $this->_mailFromName . " <" . $this->_mailFrom . ">";
            }else{
                $this->headers["From"] = $this->_mailFrom;
            }
        }
        if (count($this->_mailCc) > 0){
            for($i=0;$i<count($this->_mailCc);$i++){
                if($i==0){
                    $this->headers['Cc'] = $this->_mailCc[$i];
                }else{
                    $this->headers['Cc'] .= ", ".$this->_mailCc[$i];
                }
            }
        }
        if (count($this->_mailBcc) > 0){
            for($i=0;$i<count($this->_mailBcc);$i++){
                if($i==0){
                    $this->headers['Bcc'] = $this->_mailBcc[$i];
                }else{
                    $this->headers['Bcc'] .= ", ".$this->_mailBcc[$i];
                }
            }
        }
        if ($this->_mailVers) $this->headers["X-Mailer"] = $this->_mailVers;
        if ($this->_mailReply) $this->headers["Reply-To"] = $this->_mailReply;
        if ($this->_mailReceipt) {
            $this->headers["Disposition-Notification-To"] = $this->_mailReceipt;
            $this->headers["X-Confirm-Reading-To"] = $this->_mailReceipt;
        }
        if ($this->_mailPriority) {
            switch ($this->_mailPriority) {
                case 1:
                    $this->headers["Priority"] = "urgent";
                    $this->headers["X-Priority"] = "1";
                    $this->headers["X-MSMail-Priority"] = "Highest";
                    break;
                case 2:
                    $this->headers["Priority"] = "urgent";
                    $this->headers["X-Priority"] = "2";
                    $this->headers["X-MSMail-Priority"] = "High";
                    break;
                case 3:
                    $this->headers["Priority"] = "normal";
                    $this->headers["X-Priority"] = "3";
                    $this->headers["X-MSMail-Priority"] = "Normal";
                    break;
                case 4:
                    $this->headers["Priority"] = "non-urgent";
                    $this->headers["X-Priority"] = "4";
                    $this->headers["X-MSMail-Priority"] = "Low";
                    break;
                case 5:
                    $this->headers["Priority"] = "non-urgent";
                    $this->headers["X-Priority"] = "5";
                    $this->headers["X-MSMail-Priority"] = "Lowest";
                    break;
            }
        }
        $this->_createAttachment();
        reset($this->headers);
        $this->_mailHeaders = "";
        while (list($headername, $value) = each($this->headers)) {
            if ($value) $this->_mailHeaders .= "$headername: $value\n";
        }
    }

    /**
     * Generate the correct headers and encoding for attachments
     *
     * @return void
     */
    protected function _createAttachment()
    {
        $boundary = "--" . md5(uniqid(time()));
        if ($this->_attFile) {
            $this->headers["Content-Type"] = "multipart/mixed;\n boundary=\"" . $boundary . "\"; type=\"multipart/mixed\"";
            $mailbody = "This is a multi-part message in MIME format.\n";
            $mailbody .= "--" . $boundary;
            $mailbody .= "\nContent-Type: text/$this->_type; charset=\"$this->_charset\"\nContent-Transfer-Encoding: $this->_encoding\n\n" . $this->_mailBody . "\n";
            $i = 0;
            $sep = chr(13) . chr(10);
            for ($x = 0; $x < count($this->_attFile['name']); $x++) {
                $base = $this->_attFile['name'][$x];
                $type = $this->_attFile['type'][$x];
                $disp = $this->_attFile['disp'][$x];
                $subhdr = "--" . $boundary . "\nContent-type: $type;\n name=\"$base\"\nContent-Transfer-Encoding: base64\nContent-Disposition: $disp;\n  filename=\"$base\"\n";
                $subheader[$i++] = $subhdr;
                $fsize = $this->_attFile['size'][$x] + 1;
                $fp = fopen($this->_attFile['tmp_name'][$x], 'rb');
                $filecont = "";
                while (!feof($fp)) $filecont .= fread($fp, $fsize);
                $subheader[$i++] = chunk_split(base64_encode($filecont));
                fclose($fp);
            }
            $mailbody .= implode($sep, $subheader);
            $mailbody .= "\n--" . $boundary . "--";
            $mailbody .= "\n-- End --";
            $this->_mailBody = $mailbody;
        }
    }
}
