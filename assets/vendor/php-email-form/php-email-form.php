<?php
/**
 * Simple PHP Email Form Library
 * This replaces the premium BootstrapMade PHP Email Form library
 */

class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $ajax = false;
    public $smtp = null;
    private $messages = array();

    public function add_message($content, $label = '', $max_length = 0) {
        if ($max_length > 0 && strlen($content) > $max_length) {
            $content = substr($content, 0, $max_length);
        }
        
        if ($label) {
            $this->messages[] = "$label: $content";
        } else {
            $this->messages[] = $content;
        }
    }

    public function send() {
        try {
            // Validate required fields
            if (empty($this->to)) {
                throw new Exception('Recipient email is required');
            }
            if (empty($this->from_email)) {
                throw new Exception('Sender email is required');
            }
            if (empty($this->subject)) {
                throw new Exception('Subject is required');
            }

            // Prepare email content
            $message_body = implode("\n\n", $this->messages);
            
            // Create email headers
            $headers = array();
            $headers[] = "From: {$this->from_name} <{$this->from_email}>";
            $headers[] = "Reply-To: {$this->from_email}";
            $headers[] = "MIME-Version: 1.0";
            $headers[] = "Content-Type: text/plain; charset=UTF-8";
            $headers[] = "X-Mailer: PHP/" . phpversion();

            // Send email
            $mail_sent = mail($this->to, $this->subject, $message_body, implode("\r\n", $headers));

            if ($mail_sent) {
                return 'OK';
            } else {
                throw new Exception('Failed to send email');
            }

        } catch (Exception $e) {
            if ($this->ajax) {
                http_response_code(500);
                return $e->getMessage();
            } else {
                return $e->getMessage();
            }
        }
    }
}
?> 