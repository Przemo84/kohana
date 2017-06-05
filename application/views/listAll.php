<html>
<head>
    <title>My Articles</title>
</head>
<body>
<div class="container" style="width: 1200px">
    <header style="font-size: 30px"> List of articles</header>
    <div class="nav">
        <p>Total articles found:</p>
    </div>
    <hr>
    <div class="content">
        <table>
            <thead>
            <tr>
                <td><b>ID</b></td>
                <td><b>TITLE</b></td>
                <td><b>CONTENT</b></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td>
                        <?php echo $article['id'] ?>
                    </td>
                    <td>
                        <?php echo $article['title'] ?>
                    </td>
                    <td>
                        <?php echo $article['content'] ?>
                    </td>
                    <td>
                        <a href="articles/<?php echo $article['id'] ?>">READ</a>
                    </td>
                    <td>
                    <a href="">EDIT</a>
                    </td>
                    <td>
                    <form>
                        <button>DELETE</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>

        </table>

    </div>
</div>
</body>
</html>
