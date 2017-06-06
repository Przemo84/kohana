<html>
<head>
    <title>My Articles</title>
</head>
<body>
<div class="container" style="width: 1200px">
    <header style="font-size: 30px"> Article's details</header>
    <div class="nav">
        <br/>
        <br/>
    </div>
    <hr>
    <div class="content">
        <?php foreach ($result as $article): ?>
            <form method="post" action="/index.php/articles/store/<?php echo $article['id'] ?>">
                    <label>Title</label>
                        <input type="text" name="title" value="<?php echo $article['title'] ?>">
                    <label>Content</label>
                        <input type="text" name="content" value="<?php echo $article['content'] ?>">
                    <br/>
                    <input type="submit" value="Save">
            </form>
        <?php endforeach ?>
        <hr/>
    </div>
</div>
</body>
</html>
