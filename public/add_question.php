<?php
    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // TODO
        if (!isset($_POST["topic"]))
        {
            apologize("Please enter a topic.");
        }

        if (!isset($_POST["question"]))
        {
            apologize("Please enter a question.");
        }

        if (!isset($_SESSION["class_id"]))
        {
            $_SESSION["class_id"] = 0;
            printf("BTW, you don't have a class id.");
        }

        $date = new DateTime();
        $parse_date = $date->format('Y-m-d H:i:s');

        if (false !== query("INSERT INTO questions (class_id, asker_id, text, topic, datetime) VALUES (?, ?, ?, ?, ?)", $_SESSION["class_id"], $_SESSION["id"], $_POST["question"], $_POST["topic"], $parse_date))
        {
            printf("Question added.");
        }

        else
        {
            apologize("Your question sucks");
        }


    }
    else
    {
        // else render form
        render("../templates/add_question_form.php", ["title" => "Lookup a stock"]);
    }

?>