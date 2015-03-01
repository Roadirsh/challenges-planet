<?php
    class Mail
    {
        private $nom_expe;      //nom de l'expe
        private $email_expe;    //mail de l'expe
        private $email_reply;   //mail de réponse
        private $emails_bcc;    //messages cachés
        private $destinataires; //mails des destinataires
        private $message_text;  //message text
        private $message_html;  //message en html
        private $sujet;         //sujet du mail
        private $files;         //les fichiers
        private $frontiere;     //la frontiere  
        private $header;        //le header

        // CONSTRUIRE LE MAIL
        public function __construct($nom_expe, $email_expe, $email_reply)
        {

            // deux des param doivent être des mails // on les sépares pour differencier les messages
            if(!self::valideEmail($email_expe))
            {
                throw new InvalidArgumentException("Mail expediteur invalide!");
            }
            if(!self::valideEmail($email_reply))
            {
                throw new InvalidArgumentException("Mail de reponse invalide!");
            }

            // initialisation des propriétés
            $this->nom_expe = $nom_expe;
            $this->email_expe = $email_expe;
            $this->email_reply = $email_reply;
            $this->bcc = "";
            $this->destinataires = "";
            $this->message_text = "";
            $this->message_html = "";
            $this->sujet = "";
            $this->files = "";
            $this->frontiere = md5(uniqid(mt_rand())); // generer la frontiere entre le texte, html et PJ
            $this->header = "";
            // on a donc ici un contenu sécurisé
        }
        
        // VALIDATION D'EMAIL
        private static function valideEmail($email) //$email, sors d'ici :D
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

        public function ajouter_destinataire($mail)
        {
            if(!self::valideEmail($mail))
            {
                throw new InvalidArgumentException("Mail destinataire invalide!");
            }

            if ($this->destinataires=='')
            {
                $this->destinataires=$mail;
            }
            else
            {
                $this->destinataires.=';'.$mail;
            }
        }

        public function ajouter_bcc($mail)
        {
            if($mail != '' && !self::valideEmail($mail))
            {
                throw new InvalidArgumentException("Mail bcc invalide!");
            }
            
            if ($this->bcc=='')
            {
                $this->bcc=$mail;
            }
            else
            {
                $this->bcc.=';'.$mail;
            }
        }

        public function ajouter_pj($files)
        {
            if(!file_exists($files))
            {
                throw new InvalidArgumentException("La pj " . $files . " est invalide!");
            }

            if ($this->files=='')
            {
                $this->files=$files;
            }
            else
            {
                $this->files.=';'.$files;
            }
        }

        // DEFINITION OF THE SETTERS
        public function contenu($sujet, $message_html)
        {
            $this->sujet = $sujet;
            $this->message_html = $message_html;
            
        }

        public function envoyerMail()
        {
            
            $this->header = 'From: "'. $this->nom_expe .'" <'. $this->email_expe .'>' . "\n";
            $this->header .= 'Reply-To: <' . $this->email_reply . '>' . "\n";
            $this->header .= 'MIME-Version: 1.0 ' . "\n";
            $this->header .= "Content-Type: text/html; charset='utf-8'";
            
            mail($this->destinataires, $this->sujet, $this->message_html, $this->header);

        }
        
    }