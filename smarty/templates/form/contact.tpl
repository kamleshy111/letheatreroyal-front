<form data-form-output="form-output-global" data-form-type="contactFrm" id="contactFrm" method="post" action="">
    <div class="range range-sm-bottom spacing-20 novi-excluded">
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required" id="name" type="text" name="name" />
            <label class="form-label" for="name">Votre nom</label>
        </div>
        <div class="cell-sm-6 form-wrap">
            <input class="form-input required email" id="email" type="email" name="email" />
            <label class="form-label" for="email">Votre courriel</label>
        </div>
        <div class="cell-sm-12 form-wrap">
            <input class="form-input required" id="subject" type="text" name="subject" />
            <label class="form-label" for="subject">Sujet</label>
        </div>
        <div class="cell-xs-12 form-wrap">
            <textarea class="form-input required" id="message" name="message"></textarea>
            <label class="form-label" for="message">Message</label>
        </div>
        <div class="cell-sm-6">
            <button class="button button-primary button-square button-block" type="submit"><span>Envoyer votre message</span></button>
        </div>
    </div>
</form>
<div id="notification" class="success"></div>