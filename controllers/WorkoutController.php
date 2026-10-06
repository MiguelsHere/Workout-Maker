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
        if (!empty($_SESSION['user_id'])) {
            if ($_SESSION['user_id'] == 1) {
                $workouts = $this->workout->listAll();
            } else {
                $workouts = $this->workout->listPublic();
            }
        } else {
            header("Location: index.php?action=login");
            exit;
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
                if ($this->workout->create()) {
                    header("Location: index.php?action=edit");
                    exit;
                }
                header("Location: index.php?action=create");
                exit;
            } else {
                header("Location: index.php?action=create");
                exit;
            }
        } else {
            header("Location: index.php?action=login");
            exit;
        }

        include 'views/workout/workout_create.php';
    }

    public function delete(): void
    {
        if ($_SESSION['user_id']) {

            if (!empty($_POST['workout_id'])) {
                $this->workout->workoutId = (int) $_SESSION['workout_id'];
                $this->workout->workoutName = $_POST['workout_name'];
                if ($this->workout->delete()) {
                    header("Location: index.php?action=workout-user");
                    exit;
                }
                header("Location: index.php?action=workout-delete");
                exit;
            } else {
                header("Location: index.php?action=workout_delete");
                exit;
            }
        } else {
            header("Location: index.php");
            exit;
        }

        include 'views/workout/workout_create.php';
    }
}
