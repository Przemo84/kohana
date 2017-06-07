<html>
<head>
    <title>My Articles</title>
</head>
<body>
<div class="container" style="width: 1200px">
    <header style="font-size: 30px"> List of articles</header>
    <div class="nav" style="float: left">
        <p>Total articles found: <?php echo $counts  ?></p>
    </div>
    <div style="float: left;margin-left: 200px">
        <form action="/index.php/articles/create">
            <button>Create new Article</button>
        </form>
    </div>
    <div style="clear: both"></div>
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
                        <?php echo $article->id ?>
                    </td>
                    <td>
                        <?php echo $article->title ?>
                    </td>
                    <td>
                        <?php echo $article->content ?>
                    </td>
                    <td>
                        <a href="articles/read/<?php echo $article->id ?>">READ</a>
                    </td>
                    <td>
                    <a href="articles/edit/<?php echo $article->id ?>">EDIT</a>
                    </td>
                    <td>
                    <form action="/index.php/articles/delete/<?php echo $article->id ?>">
                        <!-- poprawić na dynamiczne przekierowanie  -->
                        <button>DELETE</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <hr/>
    </div>
</div>
</body>
</html>
