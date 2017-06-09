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
    <div style="float: left ; margin-left: 100px">
        New Article?
        <?php echo Form::open('/articles/createNewArticle'); ?>
        <?php echo Form::button('Create','Create new Article'); ?>
        <?php echo Form::close(); ?>

    </div>
    <div style="float:left ; margin-left: 100px">
        Filter:
        <form action="">
            <input type="text" name="filter">
        </form>
    </div>
    <div style="float: left;margin-left: 100px">
        Select number of articles per page:
        <form id="perPageForm" method="GET">
            <select id="selectPerPage" name="limit">
                <option></option>
                <option value="3">3</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="25">25</option>
            </select>
        </form>
    </div>
    <div style="clear: both"></div>
    <hr>
    <div class="content">
        <table id="myTable" class="tablesorter" >
            <thead cancelSelection="true">
            <tr>
                <th><b>ID</b></th>
                <th><b>TITLE</b></th>
                <th><b>CONTENT</b></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td>
                        <?php echo $article->id ?>
                    </td>
                    <td id="titleField">
                        <?php echo $article->title ?>
                    </td>
                    <td>
                        <?php echo $article->content ?>
                    </td>
                    <td>
                        <a href="/index.php/articles/read/<?php echo $article->id ?>">READ</a>
                    </td>
                    <td>
                    <a href="/index.php/articles/edit/<?php echo $article->id ?>">EDIT</a>
                    </td>
                    <td>
                    <form action="/index.php/articles/delete/<?php echo $article->id ?>">
                        <button>DELETE</button>
                    </form>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
        <hr/>
        <div>
            <?php echo $pagination ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="/application/js/jquery.tablesorter.min.js"></script>
<script>
    $(document).ready(function () {
        $("#selectPerPage").on("change", function () {
            $("#perPageForm").submit();
        })
    });
</script>
<script>
    $(document).ready(function()
        {
            $("#myTable").tablesorter();
        }
    );
</script>
<script>
    $("th").css('cursor', 'pointer');
</script>

</body>
</html>
