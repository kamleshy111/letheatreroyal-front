<section class="section section-lg bg-default" id="text{$page|ucfirst}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 pageText">
                {if ($pageText->subTitle)}
                    <h3 class="sub_title">{$pageText->subTitle}</h3>
                {/if}
                <h2 class="section_title">{$pageText->title}</h2>
                <div>{$pageText->text}</div>
            </div>
        </div>
        {if ($page eq "don")}
            {include file="form/donation.tpl"}
        {/if}
    </div>
</section>