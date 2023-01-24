<?php
require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/../controller/userHandler.php';
class User {
  
  /**
   * STATIC FUNCTIONS
   */

  /**
   * Fetch an specific user from DB
   * @param string $user The user to find
   * @return mixed The user Object, or null if no match.
   */
  static function fetchUser(string $user) {
    $result = DB::preparedQuery(
      'SELECT * FROM users WHERE username = ?', 
      [$user]);
    return empty($result[0]) ? null : $result[0];
  }
  
  /**
   * Devuelve un usuario buscandolo por su id.
   * @param int $id La id del usuario a buscar
   * @return mixed user Object, or NULL if not match
   */
  static function fetchUserId(int $id) {
    $result = DB::preparedQuery(
      'SELECT * FROM users WHERE id = ?',
      [$id]
    );
    return empty($result[0]) ? null : $result[0];
  }

  /**
   * Registra un nuevo usuario en la base de datos.
   * @param string $username
   * @param string $passwd
   * @return void
   */
  static function registerNewUser(string $username, string $passwd) {
    DB::preparedQuery(
      "INSERT INTO users(username, passwd) VALUES (?, ?)",
      [$username, $passwd]);
    initSession($username, $passwd);
  }
}

?>
