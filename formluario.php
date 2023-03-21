<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário</title>

    <script>
    function mascara(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "14");
   if (v.length == 3 || v.length == 7) i.value += ".";
   if (v.length == 11) i.value += "-";

}
</script>
</head>
<body>
          <form action="email.php" method="post">   

          <div class="mb-3">
                <label  class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu nome" required>
            </div>
            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" id="cpf"  class="form-control" placeholder="Digite seu CPF" oninput="mascara(this)" maxlength="11" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
            <input text="text" placeholder="Digite seu email" name=email id=email> </div>
          <button>Enviar</button>
    </form>
</body>
</html>