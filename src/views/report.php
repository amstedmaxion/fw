 <?= $this->layout("template", [
        'titleOnCardHeader' => 'Responsáveis'
    ])  ?>


 <form>
     <div class="mb-3">
         <label for="exampleInputEmail1" class="form-label" style="color: #4659a6;">Email address</label>
         <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp">
         <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
     </div>
     <div class="mb-3">
         <label for="exampleInputPassword1" class="form-label" style="color: #4659a6;">Password</label>
         <input type="password" class="form-control form-control-sm" id="exampleInputPassword1">
     </div>
     <div class="mb-3 form-check">
         <input type="checkbox" class="form-check-input" id="exampleCheck1">
         <label class="form-check-label" for="exampleCheck1" style="color: #4659a6;">Check me out</label>
     </div>
     <button type="submit" class="btn btn-company">Salvar dados</button>
 </form>