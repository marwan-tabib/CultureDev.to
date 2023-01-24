<?php 
    include 'database.php';
    class Article extends database{

        public function add($title , $category_id , $description){
            $title = htmlspecialchars(strip_tags($title));
            $category = htmlspecialchars(strip_tags($category_id));
            // $description = htmlspecialchars(strip_tags($description));

            $a = new database();
            $a->insert('articles',['title'=>$title,'category_id'=>$category,'description'=>$description , 'user_id'=> $_SESSION['user_info']['user_id'] , 'date' => date('d-m-y h:i:s')]);
            if ($a == true) {
                $this->sessionGenerator('success' , "Product Add Successfully");
            }
        }

        public function show(){
            $b = new database();
            // $b->select("articles","*");
            $b->select("articles INNER JOIN categories ON articles.category_id = categories.id","* , articles.id article_id , categories.name category ");
            $result = $b->sql;
            return $result;
        }

        public function destroy($id){
            $a = new database();
            $a->delete('articles',"id='$id'");
        }

        public function sessionGenerator($status = "success" , $message = "WELCOME BACK ! Login Success ... "){
            if ($status == "success") {
                $_SESSION['action'] = [
                    'status' => "Success !",
                    'class' => "alert alert-success alert-dismissible fade show",
                    'message' => $message,
                ];
            }elseif($status == "issue"){
                $_SESSION['action'] = [
                    'status' => "Problem !",
                    'class' => "alert alert-danger alert-dismissible fade show",
                    'message' => $message,
                ];
            }
        }

    }
?>