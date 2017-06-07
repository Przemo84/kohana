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
        <form>
            <button formaction="/index.php/articles">Back to List</button>
        </form>
    </div>
    <div class="content">
        <hr>
        <table>
            <thead>
            <tr>
                <td><b>ID</b></td>
                <td><b>TITLE</b></td>
                <td><b>CONTENT</b></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <?php echo $result->id ?>
                </td>
                <td>
                    <?php echo $result->title ?>
                </td>
                <td>
                    <?php echo $result->content ?>
                </td>
            </tr>
            </tbody>
        </table>
        <hr/>
        <h3>Comment this article</h3>
        <form method="POST" action="/index.php/articles/storeComment">
            <label>Username
                <input type="text" name="username" required>
            </label>
            <br/>
            <label>Your Comment
                <input type="text" name="comment" required>
            </label>
            <br/>
            <input type="submit" value="Comment!">
        </form>
        <div>
            <hr/>
            <table>
                <tbody>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><b><?php echo $comment['username'] ?></b></td>
                    </tr>
                    <tr>
                        <td><?php echo $comment['comment'] ?></td>
                    </tr>
                    <tr></tr><tr></tr><tr></tr><tr></tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
</body>
</html>
