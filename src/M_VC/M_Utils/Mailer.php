<?php
/**
 * This class is used to send emails.
 * 
 * @author Muzi Ncabane <muzi.hebron@gmail.com>
 * @package M_VC
 * @version 1.1.3
 * @copyright (c) 2020, www.hebronOnline.co.za
 */
namespace App\Utils;

use PHPMailer\PHPMailer\PHPMailer;

class Mailer 
{
    private $host;
    private $username;
    private $password;
    private $instance;

    /**
     * This functions returns instance of PHPMailer.
     * 
     * @return PHPMailer;
     */
    private function getInstance()
    {
        if ($this->instance == null) {
            $this->instance = new PHPMailer();
        }

        return $this->instance;
    }

    /**
     * Sets connection variables to your mail server.
     */
    public function configure()
    {
        $this->getInstance()->SMTPDebug = 0;
        $this->getInstance()->IsSMTP();
        $this->getInstance()->SMTPAuth   = true;                  
        $this->getInstance()->SMTPSecure = 'tls';                 
        $this->getInstance()->Host       = $this->getHost();    
        $this->getInstance()->Port       = 587;                  
        $this->getInstance()->Username   = $this->getUsername();  
        $this->getInstance()->Password   = $this->getPassword();

        $this->getInstance()->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    }

    /**
     * Sets variables of the email's sender.
     * 
     * @param string $fromEmail is the email address of the sender.
     * @param string $fromName is the name of the sender.
     * @param string $replyTo is the email address that the reciepient can use to reply to your email.
     * 
     */
    public function setSenderDetails($fromEmail, $fromName, $replyTo = null)
    {
        $this->getInstance()->From =$fromEmail;
        $this->getInstance()->FromName = $fromName;
        $this->getInstance()->addReplyTo($replyTo ?? $fromEmail);
    }

    /**
     * Sets recipient's details.
     * 
     * @param string $emailAddress is the email address of your recipient.
     * @param string $name is the name of your recipient. 
     */
    public function setRecipient($emailAddress, $name = '')
    {
        $this->getInstance()->addAddress($emailAddress, $name);
    }

    /**
     * Sets content of your email.
     * 
     * @param string $subject is the subject of your email.
     * @param string $content is the body of your email.
     * @param string $attachmentBase64 is the base64 encoded attachment for your email.
     * @param string $attachmentFileName is the name you want the file to be shown as in the email.
     * 
     */
    public function setBody($subject, $content, $attachmentBase64 = null, $attachmentFileName = null)
    {
        $this->getInstance()->Subject = $subject;
        $this->getInstance()->msgHTML($content);

        if ($attachmentBase64 <> null) {
            $this->getInstance()->addStringAttachment($attachmentBase64, $attachmentFileName ?? 'Attachment');
        }

        $this->getInstance()->isHTML(true);
    }

    /**
     * Sends email to recipient.
     * 
     * @return bool if the email was send successfully
     */
    public function sendMail()
    {
        return $this->getInstance()->send();
    }

    /**
     * Distroys instance of the PHPMailer
     */
    public function close()
    {
        $this->instance = null;
    }

    /**
     * Get the value of host
     */ 
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the value of host
     *
     * @return  self
     */ 
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}