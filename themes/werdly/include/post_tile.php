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

require_once(__DIR__ . "/../../../utilities/constants.php");

#[AllowedFunction]
function render_post(string $image, string $text, string $description) {
    return <<<EOD
    <div class="post-tile bg-gray-300 dark:bg-gray-700 rounded-xl text-balance break-all hover:scale-105 transition-transform">
        <a href="post.php" class="block w-full h-full">
            <img class="rounded-t-xl object-cover aspect-square w-full" src="$image" alt="Post Image">
            <div class="p-4">
                <h3 class="font-semibold">$text</h3>
                <span>$description</span>
            </div>
        </a>
    </div>
    EOD;
}

#[AllowedFunction]
function render_posts(array $posts) {
    return implode("", array_map(fn($post) => render_post(...$post), $posts));
}

// End of file
