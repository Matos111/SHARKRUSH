<?php
/**
 * Include este arquivo em todas as views para disponibilizar a funcao url()
 * e o script de ajuste automatico de links
 */

// Garante que o arquivo de configuracao foi carregado
if (!function_exists('url')) {
    require_once __DIR__ . '/app.php';
}
?>
<script>
(function() {
    // Base path da aplicacao (detectado pelo PHP)
    var BASE_PATH = '<?php echo BASE_PATH; ?>';

    // Funcao para ajustar URLs
    function adjustUrl(url) {
        if (!url) return url;

        // Ignora URLs absolutas (http, https, //)
        if (url.match(/^(https?:)?\/\//)) return url;

        // Ignora anchors (#)
        if (url.charAt(0) === '#') return url;

        // Ignora URLs que ja tem o base path
        if (BASE_PATH && url.indexOf(BASE_PATH) === 0) return url;

        // Ignora URLs de assets (midia, css, js)
        if (url.match(/^\/?views\/midia/)) {
            // Ajusta caminho de assets
            if (url.charAt(0) === '/') {
                return BASE_PATH + url;
            }
            return url;
        }

        // Adiciona base path a URLs absolutas
        if (url.charAt(0) === '/') {
            return BASE_PATH + url;
        }

        return url;
    }

    // Ajusta todos os links quando o DOM estiver pronto
    document.addEventListener('DOMContentLoaded', function() {
        // Ajusta hrefs
        var links = document.querySelectorAll('a[href]');
        links.forEach(function(link) {
            var href = link.getAttribute('href');
            link.setAttribute('href', adjustUrl(href));
        });

        // Ajusta form actions
        var forms = document.querySelectorAll('form[action]');
        forms.forEach(function(form) {
            var action = form.getAttribute('action');
            form.setAttribute('action', adjustUrl(action));
        });
    });

    // Exporta funcao para uso em scripts inline
    window.adjustUrl = adjustUrl;
    window.BASE_PATH = BASE_PATH;
})();
</script>
