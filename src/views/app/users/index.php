<?= $this->layout("templates/base", [
    "titleWeb" => "Users",
    "titleInCard" => "Listagem de usuários",
    "styles" => [
        css_directory("/tableResponsive.css")
    ],
    "js" => [
        js_directory("/app/users/create.js"),
        js_directory("/app/users/edit.js"),
    ]
])  ?>


<div class="row">
    <div class="col">
        <button type="button" class="btn btn-company mb-3" onclick="showCreate()">Novo Usuário</button>
    </div>
</div>

<table class="mb-3">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Age</th>
            <th>Exclusão</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($users as $userIndex => $user) { ?>
            <tr>
                <td><button class="btn btn-link" onclick="showEdit('<?= $user->id ?>')"><?= $user->id ?></button></td>
                <td><?= $user->name ?></td>
                <td><?= $user->age ?></td>
                <td><button class="btn btn-link text-danger" onclick="destroyConfirm('<?= $user->id ?>')"><i class="fa-regular fa-trash-can"></i></button></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?= $paginate?->links ?>
<?= $this->insert("components/handlePages"); ?>