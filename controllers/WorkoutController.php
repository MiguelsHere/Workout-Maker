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
        }
        header("Location: index.php?action=login");

        include 'views/workout/workout_list.php';
    }

    public function create(): void
    {
        if (!empty($_SESSION['user_id'])) {
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
            }
        } else {
            header("Location: index.php?action=login");
            exit;
        }

        include 'views/workout/workout_create.php';
    }

    public function update(): void
    {
        if (!empty($_SESSION['user_id'])) {
            if (!empty($_POST['workout_name'])) {
                $this->workout->workoutName = $_POST['workout_name'];
                $this->workout->workoutDescription = $_POST['workout_description'];
                $this->workout->timeMin = (int) $_POST['time_min'];
                $this->workout->isPublic = (int) $_POST['is_public'];
                if ($this->workout->update()) {
                    header("Location: index.php?action=edit");
                    exit;
                }
                header("Location: index.php?action=edit");
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
        if (!empty($_SESSION['user_id'])) {
            $this->workout->userId = (int) $_SESSION['user_id'];
            if (!empty($_POST['workout_id'])) {

                $this->workout->workoutId = (int) $_SESSION['workout_id'];
                $this->workout->workoutName = $_POST['workout_name'];
                if ($this->workout->delete()) {
                    header("Location: index.php?action=workout-user");
                    exit;
                }
                header("Location: index.php?action=workout-delete");
                exit;
            }
        } else {
            header("Location: index.php");
            exit;
        }

        include 'views/workout/workout_delete.php';
    }

    public function createSet(): void
    {
        if (!empty($_SESSION['user_id'])) {
            if (!empty($_POST['exercise_id'])) {

                $this->workout->exerciseId = (int) $_POST['exercise_id'];
                $this->workout->reps = (int) $_POST['reps'];
                $this->workout->setTimeSec = (int) $_POST['set_time_sec'];
                $this->workout->notes = $_POST['notes'];
                if ($this->workout->createSet()) {
                    header("Location: index.php?action=edit");
                    exit;
                }
                header("Location: index.php?action=edit");
                exit;
            }
        } else {
            header("Location: index.php?action=login");
            exit;
        }

        include 'views/workout/workout_edit.php';
    }

    public function updateSet(): void
    {
        if (!empty($_SESSION['user_id'])) {
            if (!empty($_POST['workout_id']) && !empty($_POST['set_id']) && !empty($_POST['exercise_id'])) {

                $this->workout->workoutId = (int) $_POST['workout_id'];
                $this->workout->setNumber = (int) $_POST['set_number'];
                $this->workout->setId = (int) $_POST['set_id'];
                $this->workout->exerciseId = (int) $_POST['exercise_id'];
                $this->workout->reps = (int) $_POST['reps'];
                $this->workout->setTimeSec = (int) $_POST['set_time_sec'];
                $this->workout->notes = $_POST['notes'];
                if ($this->workout->updateSet()) {
                    header("Location: index.php?action=edit");
                    exit;
                }
                header("Location: index.php?action=edit");
                exit;
            }
        } else {
            header("Location: index.php?action=login");
            exit;
        }


        include 'views/workout/workout_edit.php';
    }

    public function deleteSet(): void
    {
        if (!empty($_SESSION['user_id'])) {
            if (!empty($_POST['set_id'])) {
                $this->workout->setId = (int) $_POST['set_id'];
                if ($this->workout->deleteSet()) {
                    header("Location: index.php?action=edit");
                    exit;
                }
                header("Location: index.php?action=edit");
                exit;
            }
        } else {
            header("Location: index.php?action=login");
            exit;
        }

        include 'views/workout/workout_edit.php';
    }
}
