/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package modelo;

import java.util.Date;
import java.util.Properties;

import javax.mail.Authenticator;
import javax.mail.Message.RecipientType;
import javax.mail.MessagingException;
import javax.mail.Multipart;
import javax.mail.PasswordAuthentication;
import javax.mail.SendFailedException;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeBodyPart;
import javax.mail.internet.MimeMessage;
import javax.mail.internet.MimeMultipart;

/**
 * Este método mandará el email a partir de los datos de entrada
 *
 *
 * de Email emisor para Lista de destinatarios del email asunto Asunto del email
 * mensaje Texto que irá en el cuerpo del email
 *
 * retorna true si el mail se mandó correctamente, false en caso contrario
 *
 * @author Orion
 */
public class Email {

    public boolean enviarCorreo(String de, String para, String asunto, String mensaje) {
        boolean enviado = false;

        try {

            Properties prop = new Properties();
            prop.put("mail.smtp.host", "mail.smtp2go.com"); //Host del cual se enviará el mail
            prop.put("mail.smtp.port", "587");
            prop.put("mail.smtp.auth", "true");
            prop.put("mail.smtp.starttls.enable", "true");
            prop.put("mail.smtp.ssl.trust", "*");

            Session session = Session.getInstance(prop, new Authenticator() {

                // Metodo Override para autenticarse al servidor smtp
                @Override
                protected PasswordAuthentication getPasswordAuthentication() {
                    return new PasswordAuthentication("meeTeamSoporte@gmail.com", "3lnZaToAezdg");
                }
            });

            session.setDebug(false);

            // Crear el mensaje a enviar
            MimeMessage message = new MimeMessage(session);

            message.setFrom(new InternetAddress(de));

            message.setRecipients(RecipientType.TO, para);

            message.setSubject(asunto, "ISO-8859-1");

            // Crea el Multipart donde se introducirán todas las partes del mensaje.
            Multipart mp = new MimeMultipart();

            // create and fill the first message part
            MimeBodyPart mbp = new MimeBodyPart();
            //mbp.setContent(mensaje, "text/html");
            mbp.setContent(mensaje, "text/plain");

            mp.addBodyPart(mbp);

            message.setContent(mp);
            message.setSentDate(new Date());

            // envío del mensaje
            Transport.send(message);

            enviado = true;
        } catch (SendFailedException sfex) {
            System.out.println("SendFailedException " + sfex.getMessage() + " - " + sfex);
            enviado = false;
        } catch (MessagingException mex) {
            enviado = false;
            System.out.println("MessagingException " + mex.getMessage() + " - " + mex);
        }
        return enviado;

    }
}
