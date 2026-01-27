<form class="rd-mailform text-left contact-form" id="footerCcontactFrm" method="post" action="#">
    <input type="hidden" name="token" autocomplete="off" value="{$csrfToken}" />
    <div class="form-wrap">
        <label class="form-label" for="contact-name">Votre nom:</label>
        <input class="form-input required" id="contact-name" type="text" name="name" />
    </div>
    <div class="form-wrap">
        <label class="form-label" for="contact-email">Votre courriel:</label>
        <input class="form-input required email" id="contact-email" type="email" name="email" />
    </div>
    <div class="form-wrap">
        <label class="form-label" for="contact-subject">Sujet:</label>
        <input class="form-input required" id="contact-subject" type="text" name="subject" />
    </div>
    <div class="form-wrap">
        <label class="form-label" for="contact-message">Votre message:</label>
        <textarea class="form-input required" id="contact-message" name="message"></textarea>
    </div>
    <div class="form-button group-sm text-center text-lg-left">
        <button class="button button-primary button-square button-lg" type="submit"><span>Envoyer</span></button>
    </div>
</form>
<div id="footerCcontactNotification" class="success"></div>