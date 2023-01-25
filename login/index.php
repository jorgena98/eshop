<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dyqan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-6 col-12 mx-auto">
        <div class="p-4 bg-white rounded shadow-lg">
          <h3 class="mb-2 text-center">Log In</h3>
          <p class="text-center lead">Logohuni ne llogarine tuaj</p>
          <form action="includes/login.php"  method="POST">
            <label class="font-500" for="email">Email</label>
            <input name="login" class="form-control form-control-lg mb-3" id="email" type="email" required>
            <label class="font-500" for="password">Password</label>
            <input name="password" class="form-control form-control-lg" id="password" type="password" required>
            <button class="btn btn-primary btn-lg w-100 shadow-lg mt-4" name="submit" >Hyr</button>
          </form>
      
          <div class="mt-3">
            <a href="../index.php">
              <p  class="form-text text-center">Kthehu</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
    
</body>

</html>