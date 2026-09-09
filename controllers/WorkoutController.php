<?php
include_once 'config/Database.php';
include_once 'models/Workout.php';

class WorkoutController
{
    private $db;
    private $workout;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->workout = new Workout($this->db);
    }

    public function list(): void
    {
        if ($_SESSION['user_id'] == 0) {
            
        } else {
        }

        include 'views/workout/workout_list';
    }

    public function create(): void
    {
        if ($_SESSION['user_id']) {
            $this->workout->creatorId = (int) $_SESSION['user_id'];

            if (!empty($_POST['workout_name'])) {
                $this->workout->workoutName = $_POST['workout_name'];
                $this->workout->workoutDescription = $_POST['workout_description'];
                $this->workout->timeMin = (int) $_POST['time_min'];
                $this->workout->isPublic = (int) $_POST['is_public'];
            }
        } else {
            header("Location: index.php");
            exit;
        }

        include 'views/workout/workout_create.php';
    }
}
