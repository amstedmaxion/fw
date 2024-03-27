<form class="row g-3" action="<?= route("/users/store"); ?>" method="POST">
    <div class="col-md-6">
        <label for="name" class="form-label">Name <span>*</span></label>
        <input type="text" class="form-control <?= applyWrong("name") ?>" id="name" name="name" placeholder="Username" value="<?= applyOldInput("name") ?>">
        <small class="text-danger"><?= applyWrongText("name") ?></small>
    </div>
    
    <div class="col-md-6">
        <label for="age" class="form-label">Age <span>*</span></label>
        <input type="number" class="form-control <?= applyWrong("age") ?>" id="age" name="age" placeholder="0" value="<?= applyOldInput("age"); ?>">
        <small class="text-danger"><?= applyWrongText("age") ?></small>
    </div>
   
    <div class="col-12">
        <button type="submit" class="btn btn-company">add user</button>
    </div>
</form>