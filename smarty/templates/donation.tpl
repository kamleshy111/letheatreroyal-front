<section class="section section-lg bg-default">
    <div class="container">
        <div class="row row-30 align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6 inset-right-110">
                <div class="pre-title wow fadeInLeft" data-wow-delay=".1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInLeft;">{$donationText->subTitle}</div>
                <h2 class="wow fadeInLeft" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">{$donationText->title}</h2>
                <p class="wow fadeInLeft" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInLeft;">{$donationText->text}</p><a class="shadow btn btn-secondary offset-xl-50 wow fadeInUp" href="/don/" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">Faire un don</a>
            </div>
            <div class="col-lg-6 p-xl-0 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                {if ($donationText->featuredImage)}
                    <img src="/media/small/{$donationText->featuredImage}" alt="{$donationText->title}" />
                {/if}
            </div>
        </div>
    </div>
</section>
{*
<section class="section section-vide section-lg video-wrap vide" data-vide-bg="/video/donation" style="position: relative;">
    <div style="position: absolute; z-index: 0; inset: 0px; overflow: hidden; background-size: cover; background-color: transparent; background-repeat: no-repeat; background-position: 50% 50%; background-image: none;">
        <video autoplay="" loop="" muted="" style="margin: auto; position: absolute; z-index: -1; top: 50%; left: 50%; transform: translate(-50%, -50%); visibility: visible; opacity: 1; width: 2562px; height: auto;">
            <source src="/video/donation.mp4" type="/video/mp4">
            <source src="/video/donation.webm" type="/video/webm">
            <source src="/video/donation.ogv" type="/video/ogg">
        </video>
    </div>
    <div class="container text-center context-dark">
        <div class="h1">Contribuez</div>
        <p class="text-sm">Aidez-nous à aider les autres</p>
        <p><a class="wow fadeInUp shadow btn btn-md btn-secondary offset-xl-50 wow fadeInUp" href="/don/" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">Faites un don</a></p>
    </div>
</section>*}
{*
<div class="modal fade" id="donateModal" style="overflow:visible!important">
    <div class="modal-dialog modal-lg text-center">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
                <h1>Contribuez maintenant</h1>
                <h3>Aidez-nous à aider les autres</h3>
                <div class="donation-amounts" style="">
                    <ul class="list-unstyled list-group list-group-horizontal">
                        <li>
                            <button type="button" class="btn btn-primary btn-xl btn-block">$15</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-xl btn-block">$25</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-xl btn-block">$50</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-xl btn-block">$75</button>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-xl btn-block">$100</button>
                        </li>
                        <li>
                            <div class="control-group">
                                <div class="form-control-donate controls">
                                    <input name="textinput" placeholder="$ Other Amount" class="form-control" type="text">
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="control-group-mobile">
                        <div class="form-control-donate controls">
                            <input name="textinput" placeholder="$ Other Amount" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <br>
                <form class="form-horizontal text-center">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label class="radio-inline" for="radios-s">
                                    <input name="radios" id="radios-s" value="1" checked="checked" type="radio">
                                    Don ponctuel</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="radio-inline" for="radios-m">
                                    <input name="radios" id="radios-m" value="2" type="radio">
                                    Don mensuel</label>
                            </div>
                        </div>
                    </fieldset>
                </form>
                <button type="button" class="btn btn-donate btn-xl text-uppercase mb-2" data-dismiss="modal">Continue</button>
                <br><br>
            </div>
        </div>
    </div>
</div>
*}