<html>
<head>
    <title>My Articles</title>
</head>
<body>
<div class="container" style="width: 1200px">
    <header style="font-size: 30px"> Article's details</header>
    <div class="nav">
        <br/>
        <form>
            <button formaction="/index.php/articles">Back to List</button>
        </form>
        <br/>
    </div>
    <hr>
    <div class="content">
        <h3>Edit article:</h3><br/>
        <div class="errors">
            <ul>
                <?php if (isset($errors)): ?>
                    <h4>Errors:</h4>
                    <?php foreach ($errors as $error): ?>
                        <?php echo '<li style="color:darkred;">' . $error . '</li>' ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
        <?php echo Form::open() ?>
        <?php echo Form::label('title', 'Title') ?>
        <?php echo Form::input('title', $result ? $result->title : $validator['title']) ?>
        <br/>
        <?php echo Form::label('content', 'Content') ?>
        <?php echo Form::input('content', $result ? $result->content : $validator['content']) ?>
        <br/>
        <?php echo Form::submit(null, 'Save') ?>
        <?php echo Form::close(); ?>
        <hr/>
    </div>
</div>
</body>
</html>
