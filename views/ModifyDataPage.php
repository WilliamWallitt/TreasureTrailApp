

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">    <script
    src="https://use.fontawesome.com/releases/v5.12.1/js/all.js"
    data-search-pseudo-elements></script>
  <link rel="stylesheet" type="text/css" href='../public/stylesheets/modifyPage.css'>
<!------ Include the above in your HEAD tag ---------->
</head>
<body style="background: url('../public/img/testImage.jpg') no-repeat center fixed; background-size: cover;">

    
<!-- Navigation -->
<div class="container p-4">
  <nav class="navbar navbar-expand-lg static-top mb-5 shadow">
      <div class="container">
        <a class="navbar-link text-dark" href="/">Back</a>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link text-dark" href="/login">Log out
              <span class="sr-only">(current)</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <ul class="nav nav-pills nav-fill p-3" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Department Table</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Clue Table</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Extra Information Table</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      <div class="container p-5">
        <div class="row justify-content-center">
          <div class="col-xs-12">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <caption class="text-center">Department table</caption>
                <thead>
                  <tr>
                    <th>Department</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Computer Science and Mathematics</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="row justify-content-center p-5">
        <div class="col-xs-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <caption class="text-center">Clue table</caption>
              <thead>
                <tr>
                  <th>Clue</th>
                  <th>Information</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nemo ab magni quo nisi ad eum, harum accusantium obcaecati commodi autem, beatae non dolorum! Fugit soluta iusto obcaecati, enim quia vero.</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa eum veniam earum minima impedit dolore laudantium est ducimus, maxime esse reiciendis corporis. Necessitatibus beatae autem similique, assumenda veritatis ipsam explicabo.</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate labore dolores deleniti quam modi autem, perspiciatis nulla aliquid, nisi illum voluptatibus accusamus odio maxime consequatur qui, provident architecto! Distinctio, laudantium?</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
      <div class="row justify-content-center p-5">
        <div class="col-xs-12">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <caption class="text-center">Extra info table</caption>
              <thead>
                <tr>
                  <th>Number</th>
                  <th>Extra Information</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui blanditiis delectus libero voluptatum voluptatibus, repellat reprehenderit commodi laborum tempora consequuntur iusto distinctio cupiditate aspernatur ducimus, nemo quo maiores quaerat. Quam.
                  </td>
                  <td><i class="fas fa-minus-circle"></i></td>

                </tr>
                <tr>
                  <td>2</td>
                  <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga illum molestiae ullam culpa temporibus architecto pariatur sint corrupti, maxime enim esse ducimus quo, quam debitis nam delectus rem reprehenderit. Porro!</td>
                  <td><i class="fas fa-minus-circle"></i></td>

                </tr>
                <tr>
                  <td>3</td>
                  <td>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eveniet iusto dolor, repellat dignissimos accusamus itaque possimus debitis magni. Unde, perspiciatis neque praesentium soluta veniam nihil amet dignissimos ipsa odio quaerat?</td>
                  <td class><i class="fas fa-minus-circle"></i></td>

                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>

