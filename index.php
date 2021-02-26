<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// require the files
require "classes/Postloader.php";
require "classes/Post.php";

// listen to the send click
if (isset($_POST['send'])) {
    if ($_POST['title'] && $_POST['message'] && $_POST['name']) {
        $userPost = new Post($_POST['title'], $_POST['message'], $_POST['name']);
        $title = $userPost->getTitle();
        $userPost->getDate(date("F j, Y, g:i a"));
        $dateAndTime = $userPost->setDate();
        $content = $userPost->getContent();
        $name= $userPost->getName();
        $loader = new PostLoader($title, $dateAndTime, $content, $name);
    }
}

// retrieve the data from json file
function retrieveData() {
    if (file_get_contents("post.json")) {
        $data = file_get_contents("post.json");
        $data = json_decode($data, true);
        if (isset($data)) {
            $data = array_slice($data, -20, 20);
            return array_reverse($data);
        }
    }
}

// Display the data from json file
$display = array();
if (retrieveData()) {
    $display = retrieveData();
}

include "partials/header.php"
?>


<body class="container bg-secondary">
<h1 class="text-center my-5 display-3 text-warning">Guest Book</h1>

<section class="">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <div class="form-group">
       <label class="mb-2 text-light" for="authorName">Name: </label>
        <input id="authorName" name="name" type="text" class="form-control  mb-2 mr-sm-2"  placeholder="Type here...">
      </div>

      <div class="form-group">
        <label class="mb-2 text-light" for="title">Title: </label>
        <input id="title" name="title" type="text" class="form-control  mb-2 mr-sm-2" placeholder="Type here...">
      </div>

      <div class="form-group">
        <label class="mb-2 text-light" for="message">Message: </label>
        <textarea id="message" name="message" class="form-control"  rows="3" placeholder=""></textarea>
      </div>

      <div class="form-group">
        <input name="send" type="submit" class="btn btn-primary mt-2" value="Submit">
      </div>


</form>
</section>

      <div class="row">
          <?php foreach ($display as $post)  :?>
              <div class='card col-md-4 mt-4'>
                  <div class='card-body'>
                      <h4 class='card-title '><?php echo "Title: ".$post["title"]?></h4>
                      <h6 class='card-subtitle mb-2 text-muted'><?php echo "Name: ".$post["name"]."<br/>".$post["DTime"]?></h6>
                      <p class='card-text text-dark'><?php echo $post["content"]?></p>
                  </div>
              </div>
          <?php endforeach;?>
      </div>
<?php
include "partials/footer.php"
 ?>


    <!-- JavaScript Bundle with Popper -->
