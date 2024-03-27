 <?= $this->layout("templates/base", [
        "titleWeb" => "Title used in browser tab",
        "titleInCard" => "Welcome",
    ])  ?>


 <form>
     <button type="button" class="btn btn-company" onclick="alert('Hello, dev 🚀')">Welcome Button</button>
     <a href="<?= route("/users") ?>" class="btn btn-company">Usuários</a>
 </form>