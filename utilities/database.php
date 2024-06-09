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

require_once(__DIR__ . "/../configuration/constants.php");
require_once(__DIR__ . "/../utilities/constants.php");

function createPDO() {
    global $CONST, $CSS, $FUNC;

    try {
        $database = WERD_DATABASE->value;
        $conn = new PDO("$database:host={$CONST('WERD_DATABASE_HOST')};dbname={$CONST('WERD_DATABASE_NAME')}", WERD_DATABASE_USERNAME, WERD_DATABASE_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        define("WERD_ERROR_CODE", $e->getCode());
        define("WERD_ERROR", match(WERD_ERROR_CODE) {
            1049 => "Database `{$CONST('WERD_DATABASE_NAME')}` doesn't exist. Make sure to create it beforehand.",
            2002 => "Basic connection error. Double check if the database is running or whether the firewall is setup correctly.",
            default => $e->getMessage()
        });

        require_once(__DIR__ . "/../themes/" . WERD_THEME . "/sql_error.php");

        die;
        return null;
    }
}

// Function to create tables if they don't exist
function createTables() {
    global $CONST;
    try {
        $conn = createPDO();
        
        // SQL to create images table
        $sql_images = "CREATE TABLE IF NOT EXISTS werd_images (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        link TEXT NOT NULL,
                        description TEXT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";

        // Execute the SQL statement
        $conn->exec($sql_images);

        // SQL to create users table
        $sql_users = "CREATE TABLE IF NOT EXISTS werd_users (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        username VARCHAR(255) NOT NULL,
                        email VARCHAR(255) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL
                    )";

        // Execute the SQL statement
        $conn->exec($sql_users);

        // SQL to create posts table
        $sql_posts = "CREATE TABLE IF NOT EXISTS werd_posts (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        title VARCHAR(255) NOT NULL,
                        content TEXT NOT NULL,
                        image INT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        edited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES werd_users(id), 
                        FOREIGN KEY (image) REFERENCES werd_images(id)
                    )";

        // Execute the SQL statement
        $conn->exec($sql_posts);

        // SQL to create comments table
        $sql_comments = "CREATE TABLE IF NOT EXISTS werd_comments (
            id INT AUTO_INCREMENT PRIMARY KEY,
            post_id INT NOT NULL,
            user_id INT NOT NULL,
            comment TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (post_id) REFERENCES werd_posts(id),
            FOREIGN KEY (user_id) REFERENCES werd_users(id)
        )";

        // Execute the SQL statement
        $conn->exec($sql_comments);

        // Close the connection
        $conn = null;

        return true; // Tables were created successfully
    } catch(PDOException $e) {
        // Display error message
        echo "Connection failed: " . $e->getMessage();
        return false; // Tables creation failed
    }
}

// Inserting users into database
function insertUser($username, $email, $password) {
    try {
        $conn = createPDO();

        // SQL to insert a new user
        $sql = "INSERT INTO werd_users (username, email, password) VALUES (:username, :email, :password)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);

        $hashed_password = password_hash($password, WERD_PASSWORD_HASH);
        $stmt->bindParam(':password', $hashed_password);

        // Execute the statement
        $stmt->execute();

        // Close the connection
        $conn = null;

        return true; // User was created successfully
    } catch(PDOException $e) {
        // Display error message
        echo "Error: " . $e->getMessage();
        return false; // User creation failed
    }
}

// Fetching users from database
function fetchUser($identifier) {
    try {
        $conn = createPDO();

        // Determine whether the identifier is an ID or an email
        if (is_numeric($identifier)) {
            $sql = "SELECT * FROM werd_users WHERE id = :identifier";
        } else {
            $sql = "SELECT * FROM werd_users WHERE email = :identifier";
        }

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the identifier parameter
        $stmt->bindParam(':identifier', $identifier);

        // Execute the statement
        $stmt->execute();

        // Fetch the user as an associative array
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Close the connection
        $conn = null;

        return $user; // Return the fetched user or false if not found
    } catch(PDOException $e) {
        // Display error message
        echo "Error: " . $e->getMessage();
        return false; // Fetching user failed
    }
}

// Function to check if tables exist
function tablesExist() {
    try {
        $conn = createPDO();
        
        // SQL to check if users table exists
        $sql_check_users = "SHOW TABLES LIKE 'werd_users'";
        $stmt_check_users = $conn->prepare($sql_check_users);
        $stmt_check_users->execute();
        $users_table_exists = $stmt_check_users->fetch(PDO::FETCH_ASSOC);

        // SQL to check if posts table exists
        $sql_check_posts = "SHOW TABLES LIKE 'werd_posts'";
        $stmt_check_posts = $conn->prepare($sql_check_posts);
        $stmt_check_posts->execute();
        $posts_table_exists = $stmt_check_posts->fetch(PDO::FETCH_ASSOC);

        // SQL to check if comments table exists
        $sql_check_comments = "SHOW TABLES LIKE 'werd_comments'";
        $stmt_check_comments = $conn->prepare($sql_check_comments);
        $stmt_check_comments->execute();
        $comments_table_exists = $stmt_check_comments->fetch(PDO::FETCH_ASSOC);

        // Close the connection
        $conn = null;

        // Return true if all tables exist, false otherwise
        return ($users_table_exists && $posts_table_exists && $comments_table_exists);
    } catch(PDOException $e) {
        // Display error message
        echo "Connection failed: " . $e->getMessage();
        return false; // Unable to determine table existence
    }
}

// End of file