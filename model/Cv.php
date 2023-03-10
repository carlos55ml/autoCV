<?php
require_once __DIR__ . '/../model/DB.php';

class CV {

  public static function createCv(string $content, $userId) {
    return DB::preparedQueryRetId(
      "INSERT INTO cvs(content, user) VALUES (?, ?)",
      [$content, $userId]
    );
  }

  public static function updateCv($cvId, $newContent) {
    return DB::preparedQuery(
      'UPDATE cvs SET content=? WHERE id=?',
      [$newContent, $cvId]
    );
  }

  public static function deleteCv($userId) {
    return DB::preparedQuery(
      'DELETE FROM cvs WHERE user=?;',
      [$userId]
    );
  }

  public static function fetchUserCv($userId) {
    $result = DB::preparedQuery(
      'SELECT * FROM cvs WHERE user=?',
      [$userId]
    );
    return $result[0] ?? null;
  }


}

?>