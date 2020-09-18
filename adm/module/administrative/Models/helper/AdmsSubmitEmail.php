<?php

namespace Module\administrative\Models\helper;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AdmsSubmitEmail
 *
 * @author LeandroWEB
 */
class AdmsSubmitEmail
{

    private $result;
    private $infoConfigEmail;
    private $dados;
    
    function getResult()
    {
        return $this->result;
    }

    public function sendEmail(array $dados)
    {
        $this->dados = $dados;
        $this->credentialsSendEmail();
        if ((isset($this->infoConfigEmail[0]['host'])) && (!empty($this->infoConfigEmail[0]['host']))) {
            $this->configSendEmail();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro:
                    Insira as credenciais do email no administrativo para enviar email</div>";
            $this->result = false;
        }
    }
    
    private function configSendEmail()
    {
        $infoNome = $this->infoConfigEmail[0]['nome'];
        $infoEmail = $this->infoConfigEmail[0]['email'];
        $infoHost = $this->infoConfigEmail[0]['host'];
        $infoUsername = $this->infoConfigEmail[0]['username'];
        $infoPassword = $this->infoConfigEmail[0]['password'];
        $infoSMTPSecure = $this->infoConfigEmail[0]['smtpsecure'];
        
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = $infoHost;
            $mail->SMTPAuth = true;
            $mail->Username = $infoUsername;
            $mail->Password = $infoPassword;
            $mail->SMTPSecure = $infoSMTPSecure;
            $mail->Port = 587;

            $mail->setFrom($infoEmail, $infoNome);
            $mail->addAddress($this->dados['destino_email'], $this->dados['destino_nome']);

            $mail->isHTML(true);
            $mail->Subject = $this->dados['titulo_email'];
            $mail->Body = $this->dados['conteudo_email'];
            $mail->AltBody = $this->dados['conteudo_text_email'];

            if ($mail->send()) {
                //echo "Email enviado com sucesso";
                $this->result = true;
            } else {
                //echo "Email não enviado, tente novamente";
                $this->result = false;
            }
        } catch (Exception $e) {
            $this->result = false;
        }
    }

    private function credentialsSendEmail()
    {
        $configEmail = new \Module\administrative\Models\helper\AdmsRead();
        $configEmail->fullRead(
                "SELECT
                    *
                FROM
                    amds_configuracao_email
                WHERE
                    id =:id
                LIMIT :limit", "id=1&limit=1");
        $this->infoConfigEmail = $configEmail->getResult();
    }
}
