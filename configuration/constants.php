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

require_once(__DIR__ . "/../models/enums/versioning.php");
require_once(__DIR__ . "/../models/enums/databases.php");

// When done with configuration, modify this value to true and the website will be published
define("WERD_CONFIGURED", true);

// Theme selection
define("WERD_THEME", "werdly"); // Default value: "werdly"

// Database connection
define("WERD_DATABASE", WerdDatabase::MySQL); // Databases other than MySQL are experimental in Werd
define("WERD_DATABASE_HOST", "127.0.0.1");
define("WERD_DATABASE_USERNAME", "werd");
define("WERD_DATABASE_PASSWORD", "123");
define("WERD_DATABASE_NAME", "werd");
define("WERD_DATABASE_PATH", __DIR__ . "/../data/werd_database.db"); // Only applicable if using SQLite as database engine

// Security & encryption options
define("WERD_PASSWORD_HASH", PASSWORD_ARGON2ID); // Hashing algorithm for passwords in DB. Default value: PASSWORD_ARGON2ID (if having trouble switch to PASSWORD_BCRYPT)

// SEO & Page Info options
define("WERD_SITE_NAME", "My Werd Blog");
define("WERD_TITLE_FORMAT", "My Werd Blog - {page}");
define("WERD_POST_PAGE_FORMAT", "{title} by {author}");

define("WERD_ROOT_URL", "http://localhost/"); // Make sure to include / at the end
define("WERD_KEYWORDS", "szkoła podstawowa, bydgoszcz");
define("WERD_AUTHOR", "senge1337");
define("WERD_FAVICON", "data/werd-logo.png");
define("WERD_AUTHOR_TWITTER", "@senge1337");

/*

Do not modify these settings!

*/

define("WERD_RUNNING", true);
define("WERD_VERSION", WerdVersion::DEV);

// End of file
