"use strict";

const app = angular.module('upload-app', []);

app.controller('upload-controller', ($scope, $http) => {
    // baseURL for model files
    var modelURL = null;
    if (location.protocol === 'http') {
        modelURL = 'http://' + location.host + '/upload/models/';
    } else {
        modelURL = 'https://' + location.host + '/upload/models/';
    }
    var uploadURL = modelURL + 'upload.php';
    var recordURL = modelURL + 'records.php';
    var deleteURL = modelURL + 'delete.php';
    $scope.option = {
        "selected": null
    };
    $scope.categories = [
        {
            id: 1,
            value: "Document"
        },
        {
            id: 2,
            value: "Video"
        },
        {
            id: 3,
            value: "Audio"
        },
        {
            id: 4,
            value: "Image"
        },
        {
            id: 5,
            value: "Other"
        }
  ];

    // insert data into the database
    $scope.upload = () => {
        //alert('test');
        var formData = new FormData();
        var title = $scope.upload_title;
        console.log('What is the title? ', title);
        var category = $scope.option.selected;
        console.log('What is the category selected? ', category);
        var file = document.getElementById('file-id').files[0];
        console.log('What is the file? ', file);
        formData.append('title', title);
        formData.append('category', category);
        formData.append('file', file);

        var postData = {
            method: 'post',
            url: uploadURL,
            data: formData,
            headers: {
                'Content-Type': undefined
            },
            transformRequest: angular.identity
        };

        $http(postData).then((response) => {
            console.log(JSON.stringify(response.data, undefined, 2));
            // reload page
            $scope.reload();
        });
    };

    // get data from database
    $scope.getFiles = () => {
        $http.get(recordURL).then((response) => {
            $scope.records = response.data;
            console.log(JSON.stringify($scope.records));
        });
    };

    // delete requested file
    $scope.removeFile = (id) => {
        if (typeof id === 'string') {
            console.log("This is a string");
        }

        if (typeof id === 'number') {
            console.log("This is a number");
        }

        var deleteData = new FormData();
        deleteData.append('fileid', id);

        console.log('Deleting file: ', id);
        var deleteData = {
            method: 'post',
            url: deleteURL,
            data: deleteData,
            headers: {
                'Content-Type': undefined
            },
            transformRequest: angular.identity
        };

        $http(deleteData).then((response) => {
            console.log(JSON.stringify(response.data, undefined, 2));
            // reload page
            $scope.reload();
        });
    };

    $scope.reload = () => {
        location.reload();
    };
});
