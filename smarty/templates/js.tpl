<script src="/js/core.min.js"></script>
<script src="/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/localization/messages_fr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

<script src="https://js.stripe.com/v3/"></script>
<script src="/js/stripe.js?v={$serial}"></script>

{if ($status neq "dev")}
    <script src="https://www.google.com/recaptcha/api.js?render=6LcHSvspAAAAAJWY35Wy-5cfWGsSto5R4Sehciix"></script>
{/if}

<script src="/js/js.js?v={$serial}"></script>
{if (file_exists("{$WWW_PATH}/js/{$page}.js"))}
    <script src="/js/{$page}.js?v={$serial}"></script>
{/if}