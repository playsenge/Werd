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

require_once(__DIR__ . "/include/head.php");
require_once(__DIR__ . "/include/body.php");
require_once(__DIR__ . "/include/basic_code.php");
require_once(__DIR__ . "/configuration/constants.php");
require_once(__DIR__ . "/../../utilities/constants.php");

global $CONST, $CSS, $FUNC;

head(
    page: "Server Error",
    description: "Your web server doesn't seem to be listening to .htaccess or nginx.conf rules.",
    url: ""
);

body(
    classes: WERD_WERDLY_BODY_CLASSES
);

echo <<<EOD
    <div class="flex justify-center items-center h-screen">
        <div class="{$CSS("WERD_WERDLY_BOX_CLASSES")} max-w-[30rem] mx-8">
            <img src="/data/werd-logo.png" class="h-16">
            <span class="text-xl font-bold">Error</span>
            <span class="text-wrap">Your web server doesn't seem to be listening to {$FUNC("basic_code", ".htaccess")} or {$FUNC("basic_code", "nginx.conf")} rules.</span>
            
            Running Werd {$CONST('WERD_VERSION', enum: true)}
        </div>
    </div>
EOD;

end_body();

// End of file
