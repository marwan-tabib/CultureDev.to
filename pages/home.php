<?php include '../layouts/header.php'; ?>
<?php 
    include '../classes/Article.php';
    $article = new Article();
    $articles = $article->show();
    $categoryResult = $article->showCategories();
    if(isset($_POST['add'])){
      for ($i=0; $i < count($_POST['title']); $i++) { 
        $article->add($_POST["title"][$i] , $_POST["category"][$i] , $_POST['description'][$i]);
      }
      header('location:home.php');
    }
    if(isset($_POST['deleteArticle'])){
      $result = $article->destroy($_POST['deleteArticle']);
      header('location:home.php');
     }
    if(!isset($_SESSION['user_info'])){
      header('location:login.php');
    }
?>
<section class="container">
    <h1>Index Page</h1>
    <?php 
        include '../components/home/modal.php';
        include '../components/home/table.php';
    ?>
</section>
<?php include '../layouts/footer.php'; ?>