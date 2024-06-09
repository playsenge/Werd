<?php
/*

Werd by senge1337

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS BE LIABLE FOR ANY CLAIM, DAMAGES OR
OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,
ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

View LICENSE.md for more license & copyright information
*/

require_once(__DIR__ . "/../../../configuration/constants.php");
require_once(__DIR__ . "/../../../utilities/constants.php");

function head(string $page, string $description, string $url) {
    global $CONST;

    $schemaJSON = json_encode([
        "@context" => "https://schema.org",
        "@type" => "WebPage",
        "name" => "{$CONST('WERD_TITLE_PREFIX')}{$page}{$CONST('WERD_TITLE_SUFFIX')}",
        "description" => "{$description}",
        "url" => "{$CONST('WERD_ROOT_URL')}{$url}",
    ], JSON_UNESCAPED_SLASHES);

    echo <<<EOD
    <!DOCTYPE HTML>
    <html lang="pl-PL">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>{$CONST('WERD_TITLE_FORMAT', ['page' => $page])}</title>
        <meta name="description" content="{$description}">
        <meta name="keywords" content="{$CONST('WERD_KEYWORDS')}">
        <meta name="author" content="{$CONST('WERD_AUTHOR')}">

        <meta property="og:type" content="website">
        <meta property="og:title" content="{$CONST('WERD_TITLE_PREFIX')}{$page}{$CONST('WERD_TITLE_SUFFIX')}">
        <meta property="og:description" content="{$description}">
        <meta property="og:image" content="{$CONST('WERD_ROOT_URL')}{$CONST('WERD_FAVICON')}">
        <meta property="og:url" content="{$CONST('WERD_ROOT_URL')}{$url}">
        <meta property="og:site_name" content="{$CONST('WERD_SITE_NAME')}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{$CONST('WERD_TITLE_PREFIX')}{$page}{$CONST('WERD_TITLE_SUFFIX')}">
        <meta name="twitter:description" content="{$description}">
        <meta name="twitter:image" content="{$CONST('WERD_ROOT_URL')}{$CONST('WERD_FAVICON')}">
        <meta name="twitter:site" content="{$CONST('WERD_AUTHOR_TWITTER')}">
        <meta name="twitter:creator" content="{$CONST('WERD_AUTHOR_TWITTER')}">

        <link rel="shortcut icon" href="{$CONST('WERD_ROOT_URL')}{$CONST('WERD_FAVICON')}">
        <!-- <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
        <link rel="manifest" href="/assets/favicon/site.webmanifest">
        <link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="/assets/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="/assets/favicon/browserconfig.xml"> -->
        
        <meta name="theme-color" content="#ffffff">

        <link rel="canonical" href="{$CONST('WERD_ROOT_URL')}{$url}">

        <meta name="robots" content="index, follow">
        <meta name="theme-color" content="#76aec8">
        
        <script type="application/ld+json">
            $schemaJSON            
        </script>

        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <!-------->
    
    EOD;
}

// End of file
