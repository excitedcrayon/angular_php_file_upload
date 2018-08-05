<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Upload &copy;
        <?php echo date("Y"); ?> - bmkonto.fun </title>
</head>
<body ng-app="upload-app">
  <h2 class="text-center mt-5 mb-5">Upload File</h2>
  <div class="container" ng-controller="upload-controller">
    <div class="row">
      <div class="col-sm-12 col-md-6 col-lg-6">
        <h2>Left</h2>
        <form name="uploadform" id="uploadform" novalidate>
          <!-- title -->
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" ng-model="upload_title" class="form-control" maxlength="50" ng-minlength="3" required/>
            <small class="form-text text-muted">
              <span ng-show="uploadform.title.$error.required && uploadform.title.$touched || uploadform.title.$dirty && uploadform.title.$error.minlength">
                Please enter a title
              </span>
            </small>
          </div>
          <!-- end title -->

          <!-- category selection -->
          <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" name="category" ng-model="option.selected" ng-options="value.id as value.value for value in categories" required>
              <option value=""></option>
            </select>
            <small class="form-text text-muted">
              <span ng-show="uploadform.category.$error.required && uploadform.category.$touched">
                Please select a category
              </span>
            </small>
          </div>
          <!-- end category selection -->

          <!-- file selection -->
          <div class="form-group" ng-show="uploadform.$valid">
              <small class="form-text text-muted">
                <strong>(Max File Upload Size: 10MB) | (jpg,png,pdf,txt...)</strong>
              </small>
              <input type="file" name="file" id="file-id" class="form-control"/>
          </div>
          <!-- end file selection -->

          <button class="btn btn-primary" ng-click="upload()" ng-disabled="uploadform.$invalid">Upload</button>
          <!-- uncomment for debug purposes-->
          <!-- <p class="text-center">Is Form Valid? {{ uploadform.$valid }}</p> -->
        </form>
      </div>

      <div class="col-sm-12 col-md-6 col-lg-6">
        <h2>Files Uploaded</h2>
        <ul class="list-group" ng-init="getFiles()">
          <li class="list-group-item text-center" ng-repeat="file in records" title="{{ file.category }} : {{ file.filename }}">
            <a href="{{ file.link }}" target="_blank">
              <strong class="float-sm-left float-md-left float-lg-left float-xl-left">{{ file.name }}</strong>
            </a>
            <button class="btn btn-danger float-sm-right float-md-right float-lg-right float-xl-right" ng-click="removeFile(file.id)">Delete</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript" src="js/app.js"></script>

</html>
