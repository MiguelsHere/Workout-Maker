<?php

class Workout
{
    private $conn;

    public $workoutName;
    public $workoutDescription;
    public $timeMin;
    public $isPublic;
    public $creatorId;
    public $workoutId;

    public $userId;

    public $reps;
    public $setTimeSec;
    public $notes;
    public $exerciseId;
    public $setNumber;
    public $setId;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listAll()
    {

        $query = "SELECT workout_name FROM workout;";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listPublic()
    {
        $query = "SELECT workout_name FROM workout WHERE is_public = 1;";
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(): bool
    {
        try {
            $query = "INSERT INTO workout(workout_name, workout_description, time_min, is_public, creator_id) VALUES(:workout_name, :workout_description, :time_min, :is_public, :creator_id);";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":workout_name", $this->workoutName);
            $stmt->bindParam(":workout_description", $this->workoutDescription);
            $stmt->bindParam(":time_min", $this->timeMin);
            $stmt->bindParam(":is_public", $this->isPublic);
            $stmt->bindParam(":creator_id", $this->creatorId);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }

    public function delete(): bool
    {
        try {
            $query = "DELETE FROM user_workout WHERE workout_id = :workout_id AND user_id = :user_id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":workout_id", $this->workoutId);
            $stmt->bindParam(":user_id", $this->userId);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }

    public function createSet(): bool
    {
        try {
            $query = "INSERT INTO `set`(reps, set_time_sec, notes, workout_id, exercise_id) VALUES(:reps, :set_time_sec, :notes, :workout_id, :exercise_id);";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":reps", $this->reps);
            $stmt->bindParam(":set_time_sec", $this->setTimeSec);
            $stmt->bindParam(":notes", $this->notes);
            $stmt->bindParam(":workout_id", $this->exerciseId);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }

    public function updateSet(): bool
    {
        try {
            $query = "UPDATE `set` exercise_id = :exercise_id, reps = :reps, set_time_sec = :set_time_sec, notes = :notes, set_number = :set_number WHERE set_id = :set_id ";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":exercise_id", $this->exerciseId);
            $stmt->bindParam(":reps", $this->reps);
            $stmt->bindParam(":set_time_sec", $this->setTimeSec);
            $stmt->bindParam(":notes", $this->notes);
            $stmt->bindParam(":setNumber", $this->setNumber);
            $stmt->bindParam(":set_id",  $this->setId);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }

    public function deleteSet(): bool
    {
        try {
            $query = "DELETE FROM `set` WHERE set_id = :set_id";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":set_id", $this->setId);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            $_SESSION['alert'] = "Erro, tente novamente.";
            return false;
        }
    }
}
