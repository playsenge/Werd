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
require_once(__DIR__ . "/include/post_tile.php");
require_once(__DIR__ . "/configuration/constants.php");
require_once(__DIR__ . "/../../utilities/constants.php");

global $CONST, $CSS, $FUNC;

head(
    page: "Home",
    description: "View main posts on {$CONST('WERD_SITE_NAME')}",
    url: ""
);

body(
    classes: WERD_WERDLY_BODY_CLASSES
);

echo <<<EOD
<div class="sm:w-2/3 w-full mx-auto">
    <header class="flex flex-col sm:flex-row items-center sm:justify-center justify-between py-8">
        <!--- <span class="text-2xl font-bold sm:text-center text-left mb-4 sm:mb-0">Logo</span> --->
        <img src="/data/site-logo.png" class="h-14">

        <div class="ml-0 sm:ml-auto">
            <ul class="flex flex-wrap sm:flex-no-wrap flex-col sm:flex-row gap-x-4">
                <li>abc</li>
                <li>def</li>
                <li>ghi</li>
            </ul>
        </div>
    </header>

    <section class="recent-posts mx-auto">
        <h2 class="font-semibold text-2xl text-center sm:text-left">Recent Posts</h2>
        <div class="flex justify-center sm:px-0 px-16">
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 mt-4">
                {$FUNC('render_posts', [['https://picsum.photos/128', 'a', 'b'], ['https://picsum.photos/256', 'c', 'd'], ['https://picsum.photos/512', 'e', 'f']])}
            </div>
        </div>
    </section>

    <div class="flex justify-center items-center">
        Running Werd {$CONST('WERD_VERSION', enum: true)}
    </div>
</div>
EOD;

end_body();

// End of file
