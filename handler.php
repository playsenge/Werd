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

require_once(__DIR__ . "/configuration/constants.php");

if(!WERD_CONFIGURED) {
    require_once(__DIR__ . "/themes/" . WERD_THEME . "/unconfigured.php");
    die;
}

require_once(__DIR__ . "/utilities/database.php");

if(!tablesExist()) {
    createTables();
}

switch($_GET['page'] ?? 'main') {
    case "main":
        require_once(__DIR__ . "/themes/" . WERD_THEME . "/main.php");
        break;
}

die;

// End of file