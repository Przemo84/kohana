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
    <?php if (isset($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li style="color: darkred"><?php echo $error ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>
    <div class="content">
        <?php echo Form::open()   ?>
        <?php echo Form::label('title', 'Title')   ?>
        <?php echo Form::input('title',$validator['title'])   ?>
        <?php echo Form::label('content', 'Content')   ?>
        <?php echo Form::input('content'. $validator['content'])   ?>
        <?php echo Form::submit(null, 'Save')   ?>
        <?php echo Form::close()   ?>
        <hr/>
        <form action="/index.php/articles">
            <button >Back to List</button>
        </form>
    </div>
    </div>
</div>
</body>
</html>
