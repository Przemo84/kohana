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
            <form method="post" action="/index.php/articles/storeEditedArticle/<?php echo $result->id ?>">
                    <label>Title</label>
                        <input type="text" name="title" value="<?php echo $result->title ?>" required>
                    <label>Content</label>
                        <input type="text" name="content" value="<?php echo $result->content ?>" required>
                    <br/>
                    <input type="submit" value="Save">
            </form>
        <hr/>
    </div>
</div>
</body>
</html>
