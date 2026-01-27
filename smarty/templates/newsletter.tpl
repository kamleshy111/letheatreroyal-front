<section class="section section-vide section-lg" id="newsletter">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div>
                    {*<pre>{$dynamicText|var_dump}</pre>
                    <pre>{$dynamicText["newsletter"]|var_dump}</pre>*}
                    <h2 class="section-heading">Abonnez-vous à notre infolettre</h2>
                    <h3 class="section-subheading">Soyez informé de nos différentes activités.</h3>
                    <form class="newsletterSubscribe" method="post" id="contactFrm" action="#">
                        <div class="col-md-12 px-15">
                            <div class="form-wrap">
                                <input type="email" name="email" class="form-input required email" placeholder="Votre adresse courriel" />
                                <span class="input-group-btn"><button class="btn btn-theme btn-primary text-uppercase" type="submit">S'abonner</button></span>
                            </div>
                        </div>
                    </form>
                    <div id="newsletterSubscribeNotification"></div>
                </div>
            </div>
        </div>
    </div>
</section>