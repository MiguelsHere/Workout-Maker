<?php

class Workout
{
    private $conn;

    public $workoutName;
    public $workoutDescription;
    public $timeMin;
    public $isPublic;
    public $creatorId;

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
        $query = "INSERT INTO workout(workout_name, workout_description, time_min, is_public, creator_id) VALUES(:workout_name, :workout_description, :time_min, :is_public, :creator_id);";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":workout_name", $this->workoutName);
        $stmt->bindParam(":workout_description", $this->workoutDescription);
        $stmt->bindParam(":time_min", $this->timeMin);
        $stmt->bindParam(":is_public", $this->isPublic);
        $stmt->bindParam(":creator_id", $this->creatorId);

        $stmt->execute();

        return true;
    }
}
