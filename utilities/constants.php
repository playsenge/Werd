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

$CONST = "getConstantStripped";
$CSS = "getCSSConstant";
$FUNC = "callFunction";

#[Attribute]
class AllowedFunction {}

function getConstantStripped($constantName, $arguments=[], $enum=false) {
    if (defined($constantName)) {
        $constantValue = constant($constantName);
        if($enum) {
            $constantValue = $constantValue->value;
        }
        
        foreach($arguments as $argument => $value) {
            $constantValue = str_replace('{' . $argument . '}', $value, $constantValue);
        }
        return htmlspecialchars(strip_tags($constantValue));
    } else {
        return null; // or handle the case where the constant is not defined
    }
}

function getCSSConstant($constantName) {
    if (defined($constantName)) {
        $constantValue = constant($constantName);
        return htmlspecialchars(strip_tags(join(" ", $constantValue)));
    } else {
        return null; // or handle the case where the constant is not defined
    }
}

function callFunction(string $function, ...$parameters) {
    // Check if the function exists
    if (!function_exists($function)) {
        throw new Exception("Function $function does not exist.");
    }

    // Use reflection to get the function
    $reflection = new ReflectionFunction($function);

    // Get the attributes
    $attributes = $reflection->getAttributes(AllowedFunction::class);

    // Check if the function has the AllowedFunction attribute
    if (empty($attributes)) {
        throw new Exception("Function $function is not allowed to be called dynamically.");
    }

    // Call the function with the provided parameters
    return $reflection->invoke(...$parameters);
}

// End of file
