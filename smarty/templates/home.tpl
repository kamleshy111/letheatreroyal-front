{include file="carousel.tpl"}
<section class="section section-md bg-white text-center text-sm-left novi-background" id="home">
    <div class="shell">
        <div class="range range-50 range-md-justify range-sm-middle">
            <div class="cell-md-6 cell-lg-5 wow blurIn" data-wow-duration="1.5s" data-wow-offset="100" data-wow-delay="0">{$homeText->text}</div>
            <div class="cell-md-6 cell-lg-6 wow blurIn" data-wow-duration="1.5s" data-wow-offset="100" data-wow-delay="0">
                {if ($homeText->textImage)}
                    <div class="bg-smear">
                        <figure><img src="/media/{$homeText->textImage}" alt="{$homeText->title}" /></figure>
                    </div>
                {/if}
            </div>
        </div>
    </div>
</section>