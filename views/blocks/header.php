<?php use Engine\Decorators\Auth; ?>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="/">php.loc</a></h5>
    <?php if ($id) { ?>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="/home">Home</a>
        <?php if (Auth::allowed($id, ['manage-bp'])) {
            echo "<a class='p-2 text-dark' href='/users'>Users</a>";
        } ?>
        <?php if (Auth::allowed($id, ['manage-bp'])) {
            echo "<a class='p-2 text-dark' href='/groups'>Groups</a>";
        } ?>
        <?php if (Auth::allowed($id, ['manage-bp'])) {
            echo "<a class='p-2 text-dark' href='/business_processes'>Business Processes</a>";
        } ?>
    </nav>
    <form class="form-inline my-2 my-lg-0" action="/logout" method="post">
        <input class="btn btn-outline-danger my-2 my-sm-0" type="submit" value="Sign Out">
    </form>
    <?php } else { ?>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="btn btn-outline-success" href="/login" role="button">Sign In</a>
        <a class="btn btn-outline-primary" href="/register" role="button">Sign Up</a>
    </nav>
    <?php } ?>
</div>
