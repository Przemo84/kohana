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
            <?php foreach ($result as $article): ?>
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
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <hr/>
    </div>
</div>
</body>
</html>
