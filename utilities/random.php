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

function generateRandomCharacters($length = 16) {
    $characters = ['abcdefghijklmnpqrstuvwxyz', 'ABCDEFGHJKLMNPQRSTUVWXYZ', '23456789'];
    $id = '';
    
    for ($i = 0; $i < $length; $i++) {
        $index = random_int(0, count($characters) - 1);
        $id .= $characters[$index][random_int(0, strlen($characters[$index]) - 1)];
    }
    
    return $id;
}

// End of file