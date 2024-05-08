<?php

$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");

if(isset($_POST["rating_data"]))
{
    // Check if the user has already submitted a review for this product
    $query_check = "
    SELECT COUNT(*) as count_reviews
    FROM red_barn
    WHERE user_name = :user_name
    ";

    $statement_check = $connect->prepare($query_check);
    $statement_check->bindParam(':user_name', $_POST["user_name"]);
    $statement_check->execute();

    $result_check = $statement_check->fetch(PDO::FETCH_ASSOC);

    if($result_check['count_reviews'] > 0) {
        echo "You have already submitted a review.";
        exit; // Stop further execution
    }

    // If the user hasn't submitted a review yet, proceed to insert the review into the database
    $data = array(
        ':user_name'        =>  $_POST["user_name"],
        ':user_rating'      =>  $_POST["rating_data"],
        ':user_review'      =>  $_POST["user_review"],
        ':datetime'         =>  time()
    );

    $query = "
    INSERT INTO red_barn 
    (user_name, user_rating, user_review, datetime) 
    VALUES (:user_name, :user_rating, :user_review, :datetime)
    ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    echo "Your Review & Rating Successfully Submitted";
}

if(isset($_POST["check_duplicate"])) {
    $query_check = "SELECT COUNT(*) as count_reviews FROM red_barn WHERE user_name = :user_name";
    $statement_check = $connect->prepare($query_check);
    $statement_check->bindParam(':user_name', $_POST["user_name"]);
    $statement_check->execute();
    $result_check = $statement_check->fetch(PDO::FETCH_ASSOC);

    if($result_check['count_reviews'] > 0) {
        echo "duplicate";
        exit; // Stop further execution
    }
}


if(isset($_POST["action"]))
{
    $average_rating = 0;
    $total_review = 0;
    $five_star_review = 0;
    $four_star_review = 0;
    $three_star_review = 0;
    $two_star_review = 0;
    $one_star_review = 0;
    $total_user_rating = 0;
    $review_content = array();

    $query = "
    SELECT * FROM red_barn
    ORDER BY review_id DESC
    ";

    $result = $connect->query($query, PDO::FETCH_ASSOC);

    foreach($result as $row)
    {
        $review_content[] = array(
            'user_name'		=>	$row["user_name"],
            'user_review'	=>	$row["user_review"],
            'rating'		=>	$row["user_rating"],
            'datetime'		=>	date('l jS, F Y h:i:s A', $row["datetime"])
        );

        if($row["user_rating"] == '5')
        {
            $five_star_review++;
        }

        if($row["user_rating"] == '4')
        {
            $four_star_review++;
        }

        if($row["user_rating"] == '3')
        {
            $three_star_review++;
        }

        if($row["user_rating"] == '2')
        {
            $two_star_review++;
        }

        if($row["user_rating"] == '1')
        {
            $one_star_review++;
        }

        $total_review++;

        $total_user_rating = $total_user_rating + $row["user_rating"];

    }

    $average_rating = $total_user_rating / $total_review;

    $output = array(
        'average_rating'	=>	number_format($average_rating, 1),
        'total_review'		=>	$total_review,
        'five_star_review'	=>	$five_star_review,
        'four_star_review'	=>	$four_star_review,
        'three_star_review'	=>	$three_star_review,
        'two_star_review'	=>	$two_star_review,
        'one_star_review'	=>	$one_star_review,
        'review_data'		=>	$review_content
    );

    echo json_encode($output);

}
?>
